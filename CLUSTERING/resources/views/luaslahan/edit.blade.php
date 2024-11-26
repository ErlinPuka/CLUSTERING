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
                        <h3>Edit Data Lokasi</h3>
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
                                    <form class="form form-vertical"
                                        action="{{ route('luaslahan.update', $luaslahan->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Kecamatan</label>
                                                        <select class="form-control" name="kecamatan" id="kecamatan"
                                                            required>
                                                            <option value="">---- Pilih Kecamatan ---</option>
                                                            @foreach ($kecamatan as $k)
                                                                <option
                                                                    {{ $k->id == $luaslahan->id_kecamatan ? 'selected' : '' }}
                                                                    value="{{ $k->id }}">
                                                                    {{ $k->kecamatan }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Luas Lahan</label>
                                                        <input type="text" id="email-id-vertical" class="form-control"
                                                            placeholder="Luas Lahan" name="luas_lahan"
                                                            value="{{ $luaslahan->luas_lahan }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Tahun</label>
                                                        <input type="text" id="email-id-vertical" class="form-control"
                                                            placeholder="Tahun" name="tahun"
                                                            value="{{ $luaslahan->tahun }}" required>
                                                    </div>
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
