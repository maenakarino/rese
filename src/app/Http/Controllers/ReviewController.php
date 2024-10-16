<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $reviews = Review::all();

        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();  // ログイン中のユーザーIDを設定
        $review->shop_id = $request->input('shop_id'); // フォームからのshop_idを取得
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->back()->with('success', 'レビューが投稿されました');
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $shop = shop::find($request->shop_id);
        $reviews = Review::where('shop_id', $shop->id)->with('user')->get();

        return view('detail', compact('user', 'shop', 'reviews'));
    }

    public function destroy(Review $review)
    {
        // 口コミの所有者であることを確認
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの口コミはキャンセルできません。');
        }

        // 口コミを削除
        $review->delete();

        return redirect()->route('shop.detail', ['id' => $review->shop_id])
                     ->with('success', '口コミが削除されました。');
    }

    public function edit(Review $review)
    {
        // 口コミの所有者であることを確認
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの口コミは編集できません。');
        }

        $user = Auth::user();
        $shop = Shop::find($review->shop_id);

        return view('review', compact('review', 'user', 'shop'));
    }

    public function update(Request $request, Review $review)
    {
        // 口コミの所有者であることを確認
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの口コミは編集できません。');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Update the review
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->route('shop.detail', ['id' => $review->shop_id])
                     ->with('success', '口コミが変更されました！');
    }

    public function review()
    {
        $reviews = Review::with('shop', 'user')->get(); // Eager load related data
        

        return view('review', compact('reviews'));
    }
}
