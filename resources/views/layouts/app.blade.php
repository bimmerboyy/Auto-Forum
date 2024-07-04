<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div class="flex-container">
        <nav>
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href=""><i class="fa-solid fa-x"></i></a></li>
                <li><a href="{{ route('home') }}">Početna</a></li>
                <li><a href="{{ route('topics.index') }}">Aktuelne teme</a></li>
                <li><a href="{{ route('autoforum.info') }}">AutoForum info</a></li>
                @guest
                    <li><a href="{{ route('register.index') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('profile.index') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </ul>
            <ul>
                <li><a href="{{ route('home') }}">AutoForum</a></li>
                <li class="hideOnMobile"><a href="{{route('home') }}">Početna</a></li>
                <li class="hideOnMobile"><a href="{{route('topics.index') }}">Aktuelne teme</a></li>
                <li class="hideOnMobile"><a href="{{ route('autoforum.info') }}">AutoForum info</a></li>
                @auth
                <li><a href="{{ route('profile.index') }}">Profil</a></li>
                <li class="hideOnMobile">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" style="margin-top:10px; margin-right:10px;border:none;">Logout</button>
                    </form>
                </li>
                @endauth
                @guest
                <li class="hideOnMobile"><a href="{{route('register.index') }}">Register</a></li>
                <li class="hideOnMobile"><a href="{{route('login') }}">Login</a></li>
                @endguest
                <li class="menu-button" onclick="showSidebar()"><a href=""><i class="fa-sharp fa-solid fa-bars"></i></a></li>
            </ul>
        </nav>

        <div class="content">
            @yield('content')
        </div>

        <footer class="w-100 d-flex justify-content-center align-items-center pt-3 fs-5 fw-bold">
            <p>Copyright <i class="fa-regular fa-copyright"></i> 2022, All rights reserved</p>
        </footer>
    </div>

    <script>
        function showSidebar(){
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }
        function hideSidebar(){
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }
    </script>

    <script src="https://kit.fontawesome.com/4f1f210561.js" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
