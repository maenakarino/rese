<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
    {
        // ユーザーのお気に入りショップIDを取得
        $favorites = Auth::user()->favorites()
            ->pluck('shop_id');

        // ユーザーが予約しているお店の情報を取得
        $reserves = $this->getReservesByStatus('予約');

        // お気に入りに登録したショップ情報を取得
        $shops = Shop::with(['area', 'genre'])
            ->whereIn('id', $favorites)
            ->get();

        // ログインユーザーのマイページを表示
        return view('mypage', compact('reserves', 'shops', 'favorites'));
    }

    private function getReservesByStatus($status)
    {
        // ユーザーが指定のステータスの予約を取得
        return Auth::user()->reserves()
            ->where('status', $status)
            ->with('shop')  // 予約と関連するショップ情報も取得
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
    }
}