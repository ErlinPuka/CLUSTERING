<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut icon" href = "{{ asset('images/logo.png') }}"alt="">
    <title>Dinas Pertanian Kabupaten Sikka</title>
    <link rel="stylesheet" href="{{ asset('css/styleindex.css') }}" />

    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/table-datatable.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="container">
        <header>
            <nav>
                <input type="checkbox" id="click" />
                <label for="click" class="menu-btn">
                    <i class = "fas fa-bars"></i>
                </label>
                <ul>
                    <li><a href = "/">Home</a></li>
                    <li><a href = "login">Login</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="posterawal">
                <div class="posterawal-text">
                    <h1> Selamat Datang di Portal Clustering Wilayah Kakao Kabupaten Sikka</h1>
                    <p>Melayani Masyarakat dengan Integritas dan Inovasi</p>
                </div>
                <div class="posterawal-img">
                    <img src="{{ asset('images/sikka.png') }}" alt="Image" height="300" width="300" />
                </div>
            </div>
            <div class = "cards-categories">
                <section class="contribution-section">
                    <h2 class="contribution-title">Kakao: <span class="highlight">Emas Cokelat </span>dari Timur
                        Indonesia</h2>
                    <p class="contribution-subtitle">Nusa Tenggara Timur memiliki kontribusi besar untuk negara.</p>
                    <div class="image-grid">
                        <div class="image-container"><img src="{{ asset('images/kakao.jpeg') }}"
                                alt="Description of image 1"></div>
                        <div class="image-container"><img src="{{ asset('images/kebun.jpeg') }}"
                                alt="Description of image 2"></div>
                        <div class="image-container"><img src="{{ asset('images/kebun1.jpeg') }}"
                                alt="Description of image 2"></div>
                        <div class="image-container"><img src="{{ asset('images/kebun2.jpeg') }}"
                                alt="Description of image 2"></div>
                        <div class="image-container"><img src="{{ asset('images/kebun3.jpeg') }}"
                                alt="Description of image 2"></div>
                        <div class="image-container"><img src="{{ asset('images/kebun4.jpeg') }}"
                                alt="Description of image 2"></div>
                    </div>
                </section>
                <h2 class="contribution-title">Hasil <span>Clustering Wilayah Produksi Kakao </span>Kabupaten Sikka</h2>
                <p class="contribution-subtitle">Berdasarkan Data Badan Pusat Statistika Kabupaten Sikka</p>
                <div style="margin: 10px">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Kecamatan</th>
                                <th>Luas Lahan</th>
                                <th>Produksi</th>
                                <th>Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $item)
                                <tr>
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

            </div>
        </main>
    </div>
    <footer>
        <h4> &copy;Dinas Pertanian Kabupaten Sikka </h4>
    </footer>


    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>
</body>

</html>
