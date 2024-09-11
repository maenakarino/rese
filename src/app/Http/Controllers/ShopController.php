<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = Favorite::all();

        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function detail($id)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::with(['area', 'genre'])->find($id);

        if (!$shop) {
        return redirect('/')->with('error', '店舗が見つかりません');
    }
        $backRoute = '/';

        return view('detail', compact('shop'));
    }

    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
    }
}
