<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reserve;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function store(ReserveRequest $request, Shop $shop)
    {

        // 新しい予約を作成
        $reserve = new Reserve();
        $reserve->shop_id = $shop->id;
        $reserve->user_id = Auth::id();
        $reserve->date = $request->input('date');
        $reserve->time = $request->input('time');
        $reserve->number = $request->input('number');
        $reserve->status = '予約';

        $reserve->save();

        return redirect()->route('done')->with('success', '予約が完了しました！');
    }

    public function done()
    {
        return view('done');  // ビューが正しく返されるか確認
    }

    public function destroy(Reserve $reserve)
    {
        // 予約の所有者であることを確認
        if ($reserve->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの予約はキャンセルできません。');
        }

        // 予約を削除
        $reserve->delete();

        return redirect()->route('mypage')->with('success', '予約がキャンセルされました。');
    }

    public function edit(Reserve $reserve)
    {
        // 予約の所有者であることを確認
        if ($reserve->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの予約は編集できません。');
        }

        $user = Auth::user();
        $shop = Shop::find($reserve->shop_id);

        return view('detail', compact('reserve', 'user', 'shop'));
    }

    public function update(ReserveRequest $request, Reserve $reserve)
    {
        // 予約の所有者であることを確認
        if ($reserve->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('他のユーザーの予約は編集できません。');
        }

        

        return redirect()->route('mypage')->with('success', '予約が変更されました！');
    }
}