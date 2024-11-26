<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Lokasi;
use App\Models\TbClustering;
use App\Models\TbKecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KlasterisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TbClustering::all();
        return view('klasterisasi.index', compact('data'));
    }

    public function cetak()
    {
        $data = TbClustering::all();
        return view('klasterisasi.cetak', compact('data'));
    }

    public function proses()
    {
        // Step 1: Ambil dan akumulasi data kakao per kecamatan
        $dataKakao = Kecamatan::selectRaw('
            kecamatan.id AS id_kecamatan,
            kecamatan.kecamatan,
            luaslahan.tahun,
            SUM(luaslahan.luas_lahan) AS total_luas_lahan,
            SUM(produksi.produksi) AS total_produksi
        ')
            ->join('luaslahan', function ($join) {
                $join->on('luaslahan.id_kecamatan', '=', 'kecamatan.id');
            })
            ->join('produksi', function ($join) {
                $join->on('produksi.id_kecamatan', '=', 'kecamatan.id')
                    ->on('produksi.tahun', '=', 'luaslahan.tahun');
            })
            ->groupBy('kecamatan.id', 'kecamatan.kecamatan', 'luaslahan.tahun')
            ->get();

        // Step 2: Format data untuk K-Means
        $data = [];
        foreach ($dataKakao as $item) {
            $data[] = [
                'id_kecamatan' => $item->id_kecamatan,
                'kecamatan' => $item->kecamatan,
                'tahun' => $item->tahun,
                'total_luas_lahan' => $item->total_luas_lahan,
                'total_produksi' => $item->total_produksi
            ];
        }

        // Fungsi untuk mengecek apakah ada perubahan data
        // Buat hash dari data kakao
        $currentHash = md5(json_encode($data)); // Hash data kakao

        // Ambil hash terakhir dari database
        $lastHash = TbClustering::orderBy('created_at', 'desc')->value('data_hash');

        // Cek apakah hash berubah
        if ($currentHash === $lastHash) {
            Alert::error('Peringatan', 'Tidak ada perubahan data, proses klasterisasi tidak dilakukan.');
            return redirect('clustering');
        }

        // Step 3: Tentukan jumlah cluster
        $jumlahCluster = 3;

        // Step 4: Jalankan algoritma K-Means
        $clusters = $this->kMeans($data, $jumlahCluster);
        $centroids = $this->initCentroids($data, $jumlahCluster);

        // Step 5: Hapus data lama di tb_clustering jika ada perubahan data
        TbClustering::truncate(); // Hapus semua data di tabel tb_clustering

        // Step 6: Simpan hasil clustering ke database
        $this->insertHasilKlasterisasi($clusters, $currentHash);

        Alert::success('Success', 'Klasterisasi Berhasil');

        return redirect('clustering');
    }

    private function kMeans($data, $k)
    {
        // Step 1: Inisialisasi centroid secara acak
        $centroids = $this->initCentroids($data, $k);

        // Step 2: Mulai iterasi sampai konvergen
        $iterations = 100; // Batas maksimum iterasi
        $iterationData = []; // Initialize array to collect iteration data
        for ($i = 0; $i < $iterations; $i++) {
            $clusters = $this->assignClusters($data, $centroids);

            // Perbarui centroid
            $newCentroids = $this->updateCentroids($data, $clusters, $k);

            // Simpan data iterasi
            $iterationData[] = [
                'iteration' => $i + 1,
                'centroids' => $this->labelCentroids($centroids), // Tambahkan label ke centroids
                'clusters' => $clusters
            ];

            $this->insertIterationData($i + 1, $this->labelCentroids($centroids), $clusters);

            // Cek konvergensi
            if ($centroids == $newCentroids) {
                break;
            }
            $centroids = $newCentroids;
        }
        ksort($clusters);

        // Pastikan cluster selalu berurutan dengan label C1, C2, C3
        return $clusters;
    }

    // Fungsi untuk inisialisasi centroid secara acak
    private function labelCentroids($centroids)
    {
        $labeledCentroids = [];
        foreach ($centroids as $index => $centroid) {
            $label = '';

            switch ($index) {
                case 0:
                    $label = 'C1';  // Rendah
                    break;
                case 1:
                    $label = 'C2';  // Sedang
                    break;
                case 2:
                    $label = 'C3';  // Tinggi
                    break;
            }

            $labeledCentroids[] = [
                'label' => $label,
                'centroid' => $centroid
            ];
        }
        return $labeledCentroids;
    }

    // Fungsi untuk menyimpan hasil clustering ke dalam tabel tb_hasil_klasterisasi
    private function insertHasilKlasterisasi($clusters, $currentHash)
    {
        foreach ($clusters as $index => $clusterData) {
            $clusterLabel = '';

            // Berikan label berdasarkan urutan cluster (C1, C2, C3)
            switch ($index) {
                case 0:
                    $clusterLabel = 'C1';  // Rendah
                    break;
                case 1:
                    $clusterLabel = 'C2';  // Sedang
                    break;
                case 2:
                    $clusterLabel = 'C3';  // Tinggi
                    break;
            }

            // Insert data setiap kecamatan dalam cluster ke dalam tabel
            foreach ($clusterData as $data) {
                DB::table('tb_clustering')->insert([
                    'id_kecamatan' => $data['id_kecamatan'],
                    'tahun' => $data['tahun'],
                    'luas_lahan' => $data['total_luas_lahan'],
                    'produksi' => $data['total_produksi'],
                    'cluster' => $clusterLabel, // Simpan label cluster (C1, C2, atau C3)
                    'created_at' => now(),
                    'data_hash' => $currentHash, // Simpan hash data
                ]);
            }
        }
    }

    // Fungsi untuk inisialisasi centroid secara acak
    private function initCentroids($data, $k)
    {
        // Sortir data berdasarkan total_luas_lahan + total_produksi 
        usort($data, function ($a, $b) {
            $sumA = $a['total_luas_lahan'] + $a['total_produksi'];
            $sumB = $b['total_luas_lahan'] + $b['total_produksi'];
            return $sumA <=> $sumB; // Mengurutkan dari nilai terendah ke tertinggi
        });

        // Mengambil centroid awal berdasarkan urutan
        $centroids = [];

        // C1: Data dengan nilai terkecil (Cluster rendah)
        $centroids[] = [
            'tahun' => $data[0]['tahun'],
            'kecamatan' => $data[0]['kecamatan'],
            'total_luas_lahan' => $data[0]['total_luas_lahan'],
            'total_produksi' => $data[0]['total_produksi']
        ];

        // C2: Data dengan nilai median (Cluster sedang)
        $medianIndex = floor(count($data) / 2); // Mengambil indeks median
        $centroids[] = [
            'tahun' => $data[$medianIndex]['tahun'],
            'kecamatan' => $data[$medianIndex]['kecamatan'],
            'total_luas_lahan' => $data[$medianIndex]['total_luas_lahan'],
            'total_produksi' => $data[$medianIndex]['total_produksi']
        ];

        // C3: Data dengan nilai terbesar (Cluster tinggi)
        $lastIndex = count($data) - 1; // Mengambil indeks terakhir
        $centroids[] = [
            'tahun' => $data[$lastIndex]['tahun'],
            'kecamatan' => $data[$lastIndex]['kecamatan'],
            'total_luas_lahan' => $data[$lastIndex]['total_luas_lahan'],
            'total_produksi' => $data[$lastIndex]['total_produksi']
        ];

        return $centroids; // Mengembalikan centroid untuk C1, C2, dan C3
    }

    // Fungsi untuk menghitung centroid baru berdasarkan rata-rata titik di cluster
    private function assignClusters($data, $centroids)
    {
        //Array yang menampung titik-titik data untuk setiap cluster
        $clusters = [];
        foreach ($data as $point) {
            $minDistance = PHP_INT_MAX;
            $closestCentroid = null;
            //Iterasi dilakukan pada setiap titik data
            foreach ($centroids as $index => $centroid) {
                //Jarak dihitung menggunakan rumus Euclidean Distance
                $distance = sqrt(
                    pow($point['total_luas_lahan'] - $centroid['total_luas_lahan'], 2) +
                        pow($point['total_produksi'] - $centroid['total_produksi'], 2)
                );
                //Variabel $minDistance digunakan untuk menyimpan jarak terdekat yang ditemukan
                //Variabel $closestCentroid digunakan untuk menyimpan indeks centroid yang paling dekat.
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $index;
                }
            }
            // Variabel $closestCentroid digunakan sebagai kunci untuk menyimpan titik data dalam array $clusters
            $clusters[$closestCentroid][] = $point;
        }
        return $clusters;
    }

    private function updateCentroids($data, $clusters, $k)
    {
        $newCentroids = [];
        for ($i = 0; $i < $k; $i++) {
            if (isset($clusters[$i]) && count($clusters[$i]) > 0) {
                $luasTotal = array_sum(array_column($clusters[$i], 'total_luas_lahan'));
                $produksiTotal = array_sum(array_column($clusters[$i], 'total_produksi'));
                $clusterSize = count($clusters[$i]);

                $newCentroids[] = [
                    'total_luas_lahan' => $luasTotal / $clusterSize,
                    'total_produksi' => $produksiTotal / $clusterSize
                ];
            } else {
                // Jika cluster kosong, inisialisasi centroid baru
                $newCentroids[] = $this->initCentroids($data, 1)[0];
            }
        }
        return $newCentroids;
    }

    private function insertIterationData($iteration, $centroids, $clusters)
    {
        // Format data untuk setiap centroid, tambahkan label C1, C2, atau C3
        $labeledCentroids = [];
        foreach ($centroids as $index => $centroid) {
            $label = '';

            // Tentukan label berdasarkan index
            switch ($index) {
                case 0:
                    $label = 'C1';  // Rendah
                    break;
                case 1:
                    $label = 'C2';  // Sedang
                    break;
                case 2:
                    $label = 'C3';  // Tinggi
                    break;
            }

            // Tambahkan label ke centroid data
            $labeledCentroids[] = [
                'label' => $label,
                'centroid' => $centroid,
            ];
        }

        // Format cluster data sebagai JSON
        $centroidData = json_encode($labeledCentroids);
        $clusterData = json_encode($clusters);

        // Insert into tb_log_iterasi table
        DB::table('tb_log_iterasi')->insert([
            'iterasi' => $iteration,
            'centroid_data' => $centroidData,
            'cluster_data' => $clusterData,
            'created_at' => now(),
        ]);
    }
}
