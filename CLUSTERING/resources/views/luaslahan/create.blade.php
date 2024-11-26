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
                        <h3>Tambah Data Lokasi</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Data Lokasi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    {{-- disini yang diperbaiki --}}
                                    <form class="form form-vertical" action="{{ route('luaslahan.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- {{ csrf_field() }} --}}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    {{-- <div class="form-group">
                                                    <label for="first-name-vertical">Kecamatan</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Kecamatan" name="kecamatan" required>
                                                </div> --}}
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Kecamatan</label>
                                                        <select class="form-control" name="kecamatan" id="kecamatan"
                                                            required>
                                                            <option value="">---- Pilih Kecamatan ---</option>
                                                            @foreach ($kecamatan as $k)
                                                                <option value="{{ $k->id }}">{{ $k->kecamatan }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Luas Lahan</label>
                                                        <input type="text" id="email-id-vertical" class="form-control"
                                                            placeholder="Luas Lahan" name="luas_lahan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Tahun</label>
                                                    <select class="form-control" name="tahun" id="tahun" required>
                                                        <option value="">---- Pilih Tahun ---</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                                    </select>

                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
