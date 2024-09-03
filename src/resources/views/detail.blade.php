@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
   <div class="detail__wrap">
    <div class="detail__header">
        <div class="header__title">
            <a href="{{ $backRoute }}" class="header__back"><</a>
            <span class="header__shop-name">{{ $shop->name }}</span>
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

   <form class="reservation__wrap" action="/" method="post">
    @csrf
    <div class="reservation__content">
        <p class="reservation__title">予約</p>
        <div class="form__content">
            <input class="form__item" type="date" name="date" value="{{ request('date') }}">
        </div>
        <select class="form__content-time-select" name="time" value="{{ request('time') }}">
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
        <select class="form__content-number-select" name="number" value="{{ request('number') }}">
            <option disabled selected>人数</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
   </form>
   
   <form class="confirm-form" action="/" method="post">
    @csrf
    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr>
                <th class="table__header">Shop</th>
                <td class="table__item">{{ $shop->name }}</td>
            </tr>
            <tr>
                <th class="table__header">Date</th>
                <td class="table__item">
                    <input type="text" name="date" value="{{ $request['date'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th class="table__header">Time</th>
                <td class="table__item">
                    <input type="text" name="time" value="{{ $request['time'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th class="table__header">Number</th>
                <td class="table__item">
                    <input type="text" name="number" value="{{ $request['number'] }}" readonly />
                </td>
            </tr>
        </table>
    </div>
    <div class="form__button">
        <button class="reservation__button-btn" type="submit" name="submit" value="reserves">予約する</button>
    </div>
   </form>
@endsection
