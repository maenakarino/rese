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
        <div class="reservation-form">
            <!-- 予約フォーム -->
        <input type="date" id="date" placeholder="日付を選択" required>
        <select id="time">
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
        </select>
        <select id="number">
            <option value="1人">1人</option>
            <option value="2人">2人</option>
            <option value="3人">3人</option>
            <option value="4人">4人</option>
        </select>

        <!-- 確認表示部分 -->
        <div class="reservation-summary">
            <p>Shop: <span id="shop-name">{{ $shop->name }}</span></p>
            <p>Date: <span id="confirm-date">-</span></p>
            <p>Time: <span id="confirm-time">-</span></p>
            <p>Number: <span id="confirm-number">-</span></p>
        </div>

        <!-- 予約ボタン -->
        <button class="reserve-btn" id="reserve-button">予約する</button>
    </div>
   </form>
   
   @endif
   
   <script>
        // 入力フォームの要素を取得
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const numberInput = document.getElementById('number');

        const confirmDate = document.getElementById('confirm-date');
        const confirmTime = document.getElementById('confirm-time');
        const confirmNumber = document.getElementById('confirm-number');

        // フォームの値が変更されたら確認画面に反映する
        dateInput.addEventListener('change', () => {
            confirmDate.textContent = dateInput.value;
        });

        timeInput.addEventListener('change', () => {
            confirmTime.textContent = timeInput.value;
        });

        numberInput.addEventListener('change', () => {
            confirmNumber.textContent = numberInput.value;
        });

        // 「予約する」ボタンを押した時にアクションを追加
        document.getElementById('reserve-button').addEventListener('click', function () {
            // ここで予約確定の処理を追加（サーバーにデータ送信など）
            alert('予約が完了しました！\n日付: ' + dateInput.value + '\n時間: ' + timeInput.value + '\n人数: ' + numberInput.value);
        });
    </script>

@endsection
