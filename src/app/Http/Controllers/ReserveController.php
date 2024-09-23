<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function store(Request $request, Shop $shop)
    {
        // 新しい予約を作成
        $reserve = new Reserve();
        $reserve->shop_id = $shop->id;
        $reserve->user_id = Auth::id();
        $reserve->date = $request->input('date');
        $reserve->time = $request->input('time');
        $reserve->number = $request->input('number');
        $reserve->status = '予約';
        
        if (!$reserve->date) {
        return redirect()->back()->withErrors('予約日が必要です。');
       }

       $reserve->save();

        return redirect()->route('done')->with('success', '予約が完了しました！');
    }

    public function done()
    {
        return view('done');  // ビューが正しく返されるか確認
    }
}