@extends('template')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Clustering Kakao</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clustering</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex gap-2">
                            <form action="{{ route('clustering.proses') }}" method="post">
                                @csrf
                                <button class="btn btn-success">Proses Klastering</button>
                            </form>
                            <form action="{{ url('cetak') }}" target="_blank" method="get">
                                @csrf
                                <button class="btn btn-success">Cetak Data</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
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
                                @foreach ($data as $item)
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

            </section>
        </div>
    </div>
@endsection
