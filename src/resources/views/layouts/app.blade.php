<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rese</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <div class="app">
    <header class="header">
      <div class="header-inner">
        <a class="menu-link" href="{{ asset('menu') }}">
          <div class="menu-icon">
            <span class="line1"></span>
            <span class="line2"></span>
            <span class="line3"></span>
          </div>
          <h1 class="menu-ttl">Rese</h1>
        </a>
      </div>
    </header>
    @yield('content')
  </div>
</body>

</html>