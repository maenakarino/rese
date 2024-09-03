<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    
</head>

<body>
 <header>
  <div class="header__logo">
    <h1 class="header__heading">Rese</h1>
     @yield('link')
  </div>
  
 <div class="header__left">
  <input type="checkbox" class="drawer__hidden" id="drawer__input">
   <label for="drawer__input" class="drawer__open">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
   </label>
  <nav class="header-nav">
    <ul class="header-nav-list">
      <li class="header-nav-item"><a href="/">Home</a></li>
      <li class="header-nav-item"><a href="/mypage">Mypage</a></li>
      <li class="header-nav-item"><a href="/logout">Logout</a></li>
      <li class="header-nav-item"><a href="/register">Register</a></li>
      <li class="header-nav-item"><a href="/login">Login</a></li>
    </ul>
  </nav>
 </div>
  
 </header>
  <main>
        @yield('content')
  </main>
</body>

</html>