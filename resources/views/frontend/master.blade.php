<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEM INFORMASI KOS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="{{asset('theme/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/toastify/src/toastify.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
    <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}">
    </script>
</head>

<body class="bg-gray">
    <div class="fixed-top">
        <nav class="navbar bg-orange position-static">
            <div class="container justify-content-center">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="/" class="navbar-brand text-light fw-bold"><i class="fa fa-house"></i> SISTEM
                        INFORMASI KOS</a>
                    </div>
                    <div class="col-lg-6">
                        <!-- Formulir Pencarian -->
                        <form action="{{Route("search")}}" method="GET"
                            class="d-flex justify-content-center">
                            <input name="keyword" class="form-control me-2" type="text" placeholder="Cari Kost."
                                aria-label="Search">
                            <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/"><i class="fa fa-fire"></i> BERANDA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{Route('semua.product')}}"><i class="fa fa-house"></i> SEMUA
                                KOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('about')}}"><i class="fa fa-info-circle"></i> TENTANG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('registrasi')}}"><i class="fa fa-registered"></i> REGISTER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('login')}}"><i class="fa fa-arrow-right"></i> LOGIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('content')
    <footer class="bg-light text-dark p-4 border-top border-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="fw-bold"><i class="fa fa-store"></i> SISTEM INFORMASI KOS</h4>
                    <hr>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est nulla voluptatem ea, soluta dolorem
                    natus quisquam
                    <a href="http://"><i class="bi bi-facebook"></i></a>
                </div>
                <div class="col-lg-6">
                    <h4>SOCIAL MEDIA</h4>
                    <hr>
                    <a href="http://"><i class="text-dark fa-brands fa-facebook"></i></a>
                    <a href="http://"><i class="text-dark ms-3 fa-brands fa-instagram"></i></a>
                    <a href="http://"><i class="text-dark ms-3 fa-brands fa-youtube"></i></a>
                    <a href="http://"><i class="text-dark ms-3 fa-brands fa-linkedin"></i></a>
                    <a href="http://"><i class="text-dark ms-3 fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <hr>
            <div class="text-center">© <strong>SISTEM INFORMASI KOS</strong> • Hak Cipta Dilindungi</div>
        </div>
    </footer>
    
    <script src="{{ asset('theme/vendor/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/brands.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/regular.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/fontawesome.min.js') }}"></script>
</body>

</html>
