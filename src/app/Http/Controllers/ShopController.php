<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;

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
}
