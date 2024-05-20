<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href=""><i class="fa-solid fa-x"></i></a></li>
            <li><a href="">Početna</a></li>
            <li><a href="">Aktuelne teme</a></li>
            <li><a href="">AutoForum info</a></li>
            <li><a href="{{route('register.index') }}">Register</a></li>
            <li><a href="">Login</a></li>
        </ul>
        <ul>

            <li><a href="">AutoForum</a></li>
            <li class="hideOnMobile"><a href="">Početna</a></li>
            <li class="hideOnMobile"><a href="">Aktuelne teme</a></li>
            <li class="hideOnMobile"><a href="">AutoForum info</a></li>
            @auth
            <li class="hideOnMobile"><a href="">Postavi objavu</a></li>
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

    @yield('content')
    <footer class="position-absolute w-100 d-flex
    justify-content-center align-items-center pt-3 fs-5 fw-bold">
      <p>Copyright  <i class="fa-regular fa-copyright"></i>  2022,All rights reserved</p>
    </footer>

</footer>
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
</body>
</html>
