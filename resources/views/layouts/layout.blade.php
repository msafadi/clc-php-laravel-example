<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    @auth
                    <span class="dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown"><i class="far fa-bell"></i> (<span id="noticount">{{ Auth::user()->unreadNotifications->count() }}</span>)</a>
                        <div class="dropdown-menu" id="notilist">
                            @foreach (Auth::user()->notifications as $notification)
                            <a class="dropdown-item{{ $notification->read_at? '' : ' bg-light text-danger' }}" href="{{ route('notifications.read', [$notification->id]) }}">{{ $notification->data['message'] }}
                                <time class="text-muted">{{ $notification->created_at->diffForHumans() }}</time>
                            </a>
                            @endforeach
                        </div>
                    </span>
                    @endauth
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
    <script>
        var userId = "{{ Auth::id() }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    {{-- <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script> --}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{--
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    @auth
    <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9bbd1071bbb820b9aef1', {
      cluster: 'ap2',
      forceTLS: true,
      authEndpoint: '/broadcasting/auth'
    });

    var channel = pusher.subscribe('private-App.User.{{ Auth::id() }}');
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
      //alert(JSON.stringify(data));
      let count = parseInt($('#noticount').text());
      count += 1;
      $('#noticount').text(count);

      $('#notilist').prepend(`<a class="dropdown-item bg-light text-danger" href="${data.url}">
            ${data.message}
            <time class="text-muted">${data.time}</time>
        </a>`);
    });
  </script> 
  @endauth
  --}}
</body>

</html>