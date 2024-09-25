<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
    {

        $reserves = $this->getReservesByStatus('予約');

        $user = Auth::user();
        $reserves = $user->reserves;
        $shops = Shop::all(); // 例: 全てのショップを取得
        $favorites = Favorite::all();
        

        foreach ($reserves as $reserve) {
            echo $reserve->date;
        }

        // ログインユーザーの詳細ページを表示
        return view('mypage', compact('reserves', 'shops', 'favorites'));
    }

    private function getReservesByStatus($status)
    {
        return Auth::user()->reserves()
            ->where('status', $status)
            ->with('shop')
            ->orderBy('date', $status === '予約' ? 'asc' : 'desc')
            ->orderBy('time', $status === '予約' ? 'asc' : 'desc')
            ->get();
    }
}
