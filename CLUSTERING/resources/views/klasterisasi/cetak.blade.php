<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Clustering</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #1a1a2e;
            color: #eaeaea;
        }

        h1 {
            text-align: center;
            color: #f8f8f8;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .no-print {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .no-print button, 
        .no-print a {
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            color: #eaeaea;
            background-color: #4a4a6a; /* Warna lebih lembut */
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .no-print button:hover, 
        .no-print a:hover {
            background-color: #3a3a5a; /* Warna hover lebih gelap */
            color: #dcdcdc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 12px 10px;
            text-align: left;
        }

        th {
            background-color: #0f3460;
            color: #eaeaea;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #162447;
        }

        tr:hover {
            background-color: #1f4068;
            color: #ffffff;
        }

        /* Print styles */
        @media print {
            body {
                background-color: #fff;
                color: #000;
            }

            .no-print {
                display: none;
            }

            th, td {
                border: 1px solid #000;
                color: #000;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <button onclick="window.print()">Cetak Data </button>
            {{-- <a href="{{ url('/clustering') }}">Kembali</a> --}}
        </div>
        <h1>Data Hasil Clustering Produksi Kakao Kabupaten SIkka</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun</th>
                    <th>Kecamatan</th>
                    <th>Luas Lahan (Ha)</th>
                    <th>Produksi (Ton)</th>
                    <th>Cluster</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->kecamatan->kecamatan }}</td>
                    <td>{{ $item->luas_lahan }}</td>
                    <td>{{ $item->produksi }}</td>
                    <td>{{ $item->cluster }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
