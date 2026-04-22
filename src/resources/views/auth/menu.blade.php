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
        @if (Auth::user()->role === 1)
          <a class="menu-link" href="">Home</a>
          <a class="menu-link" href="">Register</a>
          <a class="menu-link" href="">Information Mail</a>
        @elseif(Auth::user()->role === 2)
          <a class="menu-link" href="{{ route('owners.index') }}">Create</a>
          <a class="menu-link" href="">Shop List / Edit</a>
          <a class="menu-link" href="">Reservation Check</a>
        @else
          <a class="menu-link" href="{{ route('shops.index') }}">Home</a>
          <a class="menu-link" href="{{ route('mypage.index') }}">Mypage</a>
        @endif
        <form class="logout-btn" action="{{ route('logout') }}" method="post">
          @csrf
          <button class="logout-button" type="submit">Logout</button>
        </form>
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