<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
    }

    // お気に入り削除
    public function destroy(Shop $shop)
    {
        // ログインしているユーザーのお気に入りから該当ショップを削除
        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('shop_id', $shop->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'お気に入りを削除しました！');
        }

        return redirect()->back()->withErrors('お気に入りが見つかりませんでした。');
    }
}
