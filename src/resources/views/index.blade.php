@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
  <form class="header__right" action="/" method="get">
    @csrf
    <div class="header__search">
      <label class="select-box__label">
        <select class="select-box__item" name="area" value="{{ request('area_id') }}">
            <option disabled selected>All area</option> 
        </select>
      </label>
    

    
      <label class="select-box__label">
        <select class="select-box__item" name="genre" value="{{ request('genre_id') }}">
            <option disabled selected>All genre</option>
        </select>
      </label>
    

     <div class="search__item">
        <div class="search__item-button"></div>
        <label class="search__item-label">
         <input type="text" name="word" class="search__item-input" placeholder="Search" value="{{ request('word') }}">
        </label>
      </div>
    </div>
  </form>
@endsection

@section('content')
  <div class="shop__wrap">
    @foreach ($shops as $shop)
    <div class="shop__content">
        <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ画像">
        <div class="shop__item">
            <span class="shop__title">{{ $shop->name }}</span>
            <div class="shop__tag">
                <p class="shop__tag-info">#{{ $shop->area->name }}</p>
                <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
            </div>
            <div class="shop__button">
                <a href="/detail/{{ $shop->id }}?from=index" class="shop__button-detail">詳しくみる</a>
                @if (Auth::check())
                <form action="{{ route('favorite', $shop) }}" method="post"
                                    enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                                    @csrf
                                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                        <img class="favorite__btn-image" src="{{ asset('images/heart.png') }}">
                                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
  </div>

@endsection