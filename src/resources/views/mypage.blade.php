@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
  <p class="user__name">{{ Auth::user()->name }}さん</p>
  <div class="mypage__wrap">
    <div class="reserve__wrap">
        <div class="reserve__tab">
            <label class="reserve__title hover__color--blue">
                <input type="radio" name="tab" class="reserve__title-input" checked>
                予約状況
            </label>
                @foreach ($reserves as $reserve)
            <table class="reserve__table">
                            <tr>
                                <th class="table__header">Shop</th>
                                <td class="table__item">{{ $reserve->shop->name }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Date</th>
                                <td class="table__item">{{ $reserve->date }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Time</th>
                                <td class="table__item">{{ date('H:i',strtotime($reserve->time)) }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Number</th>
                                <td class="table__item">{{ $reserve->number }}人</td>
                            </tr>
            </table>
        </div>
                @endforeach
    </div>

     <div class="favorite__wrap">
        <p class="favorite__title">お気に入り店舗</p>
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
                            <a href="/detail/{{ $shop->id }}?from=mypage" class="shop__button-detail">詳しくみる</a>
                            @if(in_array($shop->id,$favorites))
                                <form action="{{ route('unfavorite',$shop) }}" method="post" class="shop__button-favorite">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                            <img class="favorite__btn-image" src="{{ asset('images/heart_color.svg') }}">
                                        </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
  