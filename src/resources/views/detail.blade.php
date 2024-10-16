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
   @if (Auth::check())
   <div class="review-section">
    <h2 class="review-header">レビュー</h2>
    <a href="/review" class="all-review__button">全ての口コミを見る</a>
    @foreach ($reviews ?? [] as $review)
      <div class="reviews-list">
            <p>評価: {{ $review->rating }}/5</p>
            <p>コメント: {{ $review->comment }}</p>
            <p>投稿者: {{ $review->user->name }}</p>
      </div>
    @endforeach

    <h3 class="review-header">レビューを投稿する</h3>
    <div class="review-form">
    <form action="{{ request()->is('*edit*') ? route('review.update', $review) : route('review.store', $shop) }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <div>
            <label for="rating" class="rating">評価 (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
        </div>
        <div>
            <label for="comment" class="comment">コメント:</label>
            <textarea name="comment" rows="5" required></textarea>
        </div>
        <button type="submit">{{ request()->is('*edit*') ? '投稿内容を変更する' : '投稿する' }}</button>
    </form>
    </div>
    </div>
   </div>
   <form class="reservation__wrap" action="{{ request()->is('*edit*') ? route('reserve.update', $reserve) : route('reserve', $shop) }}" method="post">
    @csrf
    <div class="reservation__content">
        <p class="reservation__title">{{ request()->is('*edit*') ? '予約変更' : '予約' }}</p>
        <div class="reservation-form">
            <!-- 予約フォーム -->
            <input type="date" id="date" name="date" placeholder="日付を選択" value="{{ request()->is('*edit*') ? $reserve->date : '' }}">
            <div class="form__error">
                  @error('date')
                  {{ $message }}
                  @enderror
            </div>
            <select id="time" name="time">
                <option value="" {{ request()->is('*edit*') && isset($reserve->time) ? '' : 'selected' }}
                        disabled>-- 時間を選択してください --</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
            </select>
            <div class="form__error">
                  @error('time')
                  {{ $message }}
                  @enderror
            </div>
            <select id="number" name="number">
                <option value="" {{ request()->is('*edit*') && isset($reserve->time) ? '' : 'selected' }}
                        disabled>--人数を選択してください --</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
            </select>
            <div class="form__error">
                  @error('number')
                  {{ $message }}
                  @enderror
            </div>

            <!-- 確認表示部分 -->
            <div class="reservation-summary">
                <p>Shop: <span id="shop-name">{{ $shop->name }}</span></p>
                <p>Date: <span id="confirm-date">{{ request()->is('*edit*') ? $reserve->date : '' }}</span></p>
                <p>Time: <span id="confirm-time">{{ request()->is('*edit*') ? date('H:i', strtotime($reserve->time)) : '' }}</span></p>
                <p>Number: <span id="confirm-number">{{ request()->is('*edit*') ? $reserve->number . '人' : '' }}</span></p>
            </div>

            <!-- 予約ボタン -->
            <button type="submit" class="reserve-btn" id="reserve-button">{{ request()->is('*edit*') ? '予約内容を変更する' : '予約する' }}</button>
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
</script>

@endsection
