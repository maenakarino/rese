@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="review__wrap">
        <div class="review__tab">
            <label class="review__title hover__color--blue">
                <input type="radio" name="tab" class="review__title-input" checked>
                レビュー
            </label>
            <div class="review__content-wrap">
                @if($reviews->isEmpty())
                    <p>No reviews available for this shop.</p>
                @else
                    @foreach ($reviews as $review)
                        <div class="review__content">
                            <div class="review__header">
                                <p class="header__title review__header__title">口コミ{{ $loop->iteration }}</p>
                                @if(Auth::check() && Auth::id() === $review->user_id)
                                    <div class="review__header-button">
                                        <form action="{{ route('review.edit',$review) }}" method="get" class="header__form">
                                            <button type="submit" class="form__button--edit" onclick="return confirmEdit()" title="レビュー編集">
                                                <img src="{{ asset('images/edit.svg') }}" alt="レビュー編集" class="form__button-img">
                                            </button>
                                        </form>
                                        <form action="{{ route('review.destroy',$review) }}" method="post"  class="header__form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="form__button--cancel" onclick="return confirmCancel()" title="レビュー取り消し">
                                                <img src="{{ asset('images/batsu.svg') }}" alt="レビュー取り消し" class="form__button-img">
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <table class="review__table">
                                <tr>
                                    <th class="table__header">User</th>
                                    <td class="table__item">{{ $review->user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="table__header">Rating</th>
                                    <td class="table__item">{{ $review->rating }}</td>
                                </tr>
                                <tr>
                                    <th class="table__header">Comment</th>
                                    <td class="table__item">{{ $review->comment }}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
    function confirmEdit() {
        return confirm('Are you sure you want to edit this review?');
    }

    function confirmCancel() {
        return confirm('Are you sure you want to delete this review? This action cannot be undone.');
    }
    </script>
@endsection