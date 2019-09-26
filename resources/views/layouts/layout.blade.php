<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Website Title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <header>

        <div class="topbar">
            <div class="container py-1 d-flex flex-wrap justify-content-between">
                <div>
                    <img src="/assets/images/logo.png" alt="Logo">
                </div>
                <nav class="nav">
                    <a class="nav-link" href="#"><i class="fas fa-rss"></i></a>
                    <a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="nav-link" href="#"><i class="fab fa-linkedin-in"></i></a>
                </nav>
            </div>
        </div>
        <div class="container d-flex flex-wrap justify-content-between">
            <nav class="top-nav">
                <ul class="nav">
                    <li class="nav-item"><a href="" class="nav-link active">{{ $title ?? 'Home' }}</a></li>
                    <li class="nav-item"><a href="" class="nav-link">About us</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Service</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Pages</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Contact us</a></li>
                </ul>
            </nav>
            <form action="" class="form-inline">
                <input type="search" placeholder="Search something" class="form-control">
            </form>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @yield('footer')
    </footer>

    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>