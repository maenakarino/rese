@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
    <div class="review__wrap">
        <div class="review__tab">
            <label class="review__title hover__color--blue">
                <input type="radio" name="tab" class="review__title-input" checked>
                レビュー編集
            </label>

            <div class="review__content-wrap">
                @if (empty($review))
                    <p>No review available for editing.</p>
                @else
                    <div class="review__content">
                      <div class="review-form">
                        <!-- 編集フォームの内容 -->
                        <form action="{{ route('review.update', ['id' => $review->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="rating">評価</label>
                                <input class="rating" type="number" name="rating" id="rating" value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
                            </div>

                            <div>
                                <label class="comment" class="comment" for="comment">コメント</label>
                                <textarea class="textarea" name="comment" id="comment" rows="5" required>{{ old('comment', $review->comment) }}</textarea>
                            </div>

                            <button type="submit">レビューを更新</button>
                        </form>
                      </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection