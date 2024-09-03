@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
  <form class="header__right" action="/" method="get">
    @csrf
    <div class="header-search__area">
      <label class="select-box__label">
        <select class="header-search__area-select" name="area" value="{{ request('area_id') }}">
            <option disabled selected>All area</option> 
        </select>
      </label>
    </div>

    <div class="header-search__genre">
      <label class="select-box__label">
        <select class="header-search__genre-select" name="genre" value="{{ request('genre_id') }}">
            <option disabled selected>All genre</option>
        </select>
      </label>
    </div>

    <div class="search__item">
        <div class="search__item-button"></div>
        <label class="search__item-label">
         <input type="text" name="word" class="search__item-input" placeholder="Search" value="{{ request('word') }}">
        </label>
    </div>
  </form>
@endsection

@section('content')
  <div class="shop__wrap">
    <div class="shop__content">
        <img class="shop__image" src="(!isset($shop->image_url))" alt="イメージ画像">
        <div class="shop__item">
            <span class="shop__title">(!isset($shop->name))</span>
            <div class="shop__tag">
                <p class="shop__tag-info">#(!isset($shop->area->name))</p>
                <p class="shop__tag-info">#(!isset($shop->genre->name))</p>
            </div>
            <div class="shop__button">
                <a href="/detail/(!isset($shop->id))?from=index" class="shop__button-detail">詳しくみる</a>
                <form action="{{ route('favorite', (!isset($shop))) }}" method="post"
                                    enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                                    @csrf
                                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                        <img class="favorite__btn-image" src="{{ asset('images/heart.svg') }}">
                                    </button>
                </form>
@endsection