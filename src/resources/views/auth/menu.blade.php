<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rese</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/auth/menu.css') }}" />
</head>

<body>
  <div class="menu-wrapper">
    <div class="menu-button">
      <a href="{{ route('shops.index') }}" class="back-btn">
        <span class="batsu"></span>
      </a>
    </div>
    <div class="menu-wrapper__link">
      @auth
        <a class="menu-link" href="{{ route('shops.index') }}">Home</a>
        <form class="logout-btn" action="{{ route('logout') }}" method="post">
          @csrf
          <button class="logout-button" type="submit">Logout</button>
        </form>
        <a class="menu-link" href="{{ route('mypage.index') }}">Mypage</a>
      @endauth

      @guest
        <a class="menu-link" href="{{ route('shops.index') }}">Home</a>
        <a class="menu-link" href="{{ route('register') }}">Registration</a>
        <a class="menu-link" href="{{ route('login') }}">Login</a>
      @endguest
    </div>
  </div>
</body>

</html>