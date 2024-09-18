@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
  <form class="header__right" action="/search" method="get">
       @csrf 
        <div class="header__search">
            <label class="select-box__label">
                <select name="area_id" class="select-box__item">
                    <option value="">All area</option>
                    @foreach ($areas as $area)
                        <option class="select-box__option" value="{{ $area['id'] }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                            {{ $area['name'] }}</option>
                    @endforeach
                </select>
            </label>
            

            <label class="select-box__label">
                <select name="genre_id" class="select-box__item">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre['id'] }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre['name'] }}</option>
                    @endforeach
                </select>
            </label>

            <div class="search__item">
                <div class="search__item-button"></div>
                <label class="search__item-label">
                    <input type="text" name="word" class="search__item-input" placeholder="Search ..." value="{{ old('keyword') }}">
                </label>
            </div>
            <div class="search-form__actions">
                      <input class="search-form__search-btn btn" type="submit" value="検索">
            </div>
        </div>
    </form>

    <div class="header__right--hidden">
        <div class="search__icon">
            <input id="drawer__input-search" class="drawer__hidden-search" type="checkbox">
            <label for="drawer__input-search" class="drawer__open-search"><span></span></label>
            <div class="overlay"></div>
            <div class="search__content">
                <form action="/" method="get" class="search__form">
                    @csrf
                    <div class="search__select">
                        <label class="select-box__label">
                            <select name="area" class="select-box__item">
                                <option value="">All area</option>
                                @foreach ($areas as $area)
                                    <option class="select-box__option" value="{{ $area->id }}"
                                        {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label class="select-box__label">
                            <select name="genre" class="select-box__item">
                                <option value="">All genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="search__text">
                        <div class="search__item">
                            <div class="search__item-button"></div>
                            <label class="search__item-label">
                                <input type="text" name="word" class="search__item-input" placeholder="Search ..."
                                    value="{{ request('word') }}">
                            </label>
                        </div>
                    </div>
                    <div class="search-form__actions">
                      <input class="search-form__search-btn btn" type="submit" value="検索">
                    </div>
                </form>
            </div>
        </div>
    </div>
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