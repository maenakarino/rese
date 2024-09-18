<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Favorite;
use App\Models\Reserve;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function store(Shop $shop, Request $request)
    {
        $reserve = new Reserve();
        $reserve->shop_id = $shop->id;
        $reserve->user_id = Auth::user()->id;
        $reserve->date = $request->input('date');
        $reserve->time = $request->input('time');
        $reserve->number = $request->input('number');
        

        

        return view('done', compact('date', 'time', 'number'));

    }
}
