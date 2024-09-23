@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
   <div class="detail__wrap">
    <div class="detail__header">
        <div class="header__title">
            <a href="/" class="header__back"><</a>
            <span class="header__shop-name">{{ $shop->name ?? '店舗名がありません' }}</span>
        </div>
    </div>
    <div class="detail__image">
        <img src="{{ $shop->image_url }}" alt="イメージ画像" class="detail__image-img">
    </div>
    <div class="detail__tag">
        <p class="detail__tag-info">#{{ $shop->area->name }}</p>
        <p class="detail__tag-info">#{{ $shop->genre->name }}</p>
    </div>
    <div class="detail__outline">
        <p class="detail__outline-text">{{ $shop->outline }}</p>
    </div>
   </div>

   @if (Auth::check())
   <form class="reservation__wrap" action="{{ route('reserve', $shop->id) }}" method="post">
    @csrf
    <div class="reservation__content">
        <p class="reservation__title">予約</p>
        <div class="form__content">
            <input class="form__item" type="date" name="date" value="{{ request('date') }}">
        </div>
        <select class="form__content-time-select" type="time" name="time" value="{{ request('time') }}">
            <option disabled selected>時間</option>
            <option value="1">17:00</option>
            <option value="2">17:30</option>
            <option value="3">18:00</option>
            <option value="4">18:30</option>
            <option value="5">19:00</option>
            <option value="6">19:30</option>
            <option value="7">20:00</option>
            <option value="8">20:30</option>
            <option value="9">21:00</option>
        </select>
        <select class="form__content-number-select" type="number" name="number" value="{{ request('number') }}">
            <option disabled selected>人数</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <div class="form__button">
        <button class="reservation__button-btn" type="submit">予約する</button>
        </div>
   </form>
   
   @endif
@endsection
