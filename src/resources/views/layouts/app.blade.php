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
  
  
 <div class="header__left">
  <input type="checkbox" class="drawer__hidden" id="drawer__input">
   <label for="drawer__input" class="drawer__open">
    <span></span>
   </label>
  <nav class="header-nav">
    <ul class="header-nav-list">
      <li class="header-nav-item"><a class="nav__item-link" href="/">Home</a></li>
    @if (Auth::check())
      <li class="header-nav-item"><a class="nav__item-link" href="/mypage">Mypage</a></li>
     <form class="form" action="/logout" method="post">
      @csrf
      <li class="header-nav-item"><a class="nav__item-link" href="/logout">Logout</a></li>
     </form>
    @else
      <li class="header-nav-item"><a class="nav__item-link" href="/register">Register</a></li>
      <li class="header-nav-item"><a class="nav__item-link" href="/login">Login</a></li>
    @endif
    </ul>
  </nav>
 </div>

 <div class="header__logo">Rese</div>
 @yield('header')
  
 </header>
  <main>
        @yield('content')
  </main>
</body>

</html>