<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
</head>

<body>
    <main>
        @include('inc.navbar')
        <div class="container-fluid">

            <div class="row mx-auto">
                <div class="col-sm-12 col-lg-8">
                    @yield('content')
                </div>

                <div class="col-sm-12 col-lg-4">
                    @yield('SideBarRight')
                </div>
            </div>

            <div class="row">
                @yield('banners')
            </div>

            @yield('news')
            @yield('partners')

        </div>

        <div class="container-fluid footer">
            @if(Auth::check())
                <a class="nav-link" href="{{ route('login') }}">{{ __('Panel Administratora') }}</a>
            @else
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endif
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>