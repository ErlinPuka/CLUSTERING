<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Indah Cemerlang</title>

    <link rel="Shortcut icon" href = "{{ asset('images/Logobaru.jpg') }}"alt="">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/table-datatable.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/auth.css') }}">

</head>

<body>
    <script src="{{ asset('static/js/initTheme.js') }}"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Register.</h1>
                    <p class="auth-subtitle mb-4">Silakan register untuk mendapatkan akses</p>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative  mb-4">
                            <input type="text" name="name" class="form-control form-control-xl" placeholder="Nama">
                        </div>
                        <div class="form-group position-relative  mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email">
                        </div>
                        <div class="form-group position-relative  mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Register</button>
                    </form>
                    <div class="text-center text-lg fs-4 mt-3">
                        <p class="text-gray-600">Sudah punya akun? <a href="{{ url('login') }}" class="font-bold">Log in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right" class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-center">
                        <img src="{{ asset('images/sikka.png') }}" alt="Logo">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('static/js/components/dark.js') }}"></script>
    <script src="{{ asset('extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('compiled/js/app.js') }}"></script>

    @include('sweetalert::alert')

    <!-- Need: Apexcharts -->
    <script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('static/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>

</body>

</html>
