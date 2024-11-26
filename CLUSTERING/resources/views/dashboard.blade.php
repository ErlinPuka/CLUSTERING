@extends('template')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Dashboard</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img class="rounded" style="margin-right: 20px"
                                            src="{{ asset('images/sikka.png') }}" alt="Foto Perusahaan" width="100"
                                            height="100">
                                        <div class="">
                                            <h2 class="">Dinas Pertanian Kabupaten Sikka</h2>
                                            <p class=""><i class="bi bi-geo-alt-fill" style="margin-right: 5px"></i>
                                                Jalan Litbang
                                                Wairklau
                                                Kota Uneng, Kecamatan Alok, Maumere, Nusa Tenggara Timur</p>
                                            <p class=""><i class="bi bi-telephone-fill" style="margin-right: 5px"></i>
                                                085646623447</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
@endsection
