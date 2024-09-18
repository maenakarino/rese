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

    public function store(Request $request)
    {
        

        Shop::create($shop);
        return redirect('/');
    }

    public function search(Request $request)
{
    // フィルターに基づく検索を構築する
    $area_id = $request->input('area_id');
    $genre_id = $request->input('genre_id');

    // エリアとジャンルのリストを取得
    $areas = Area::all();
    $genres = Genre::all();

    // Shopモデルのクエリビルダーを取得
    $query = Shop::with(['area', 'genre']);  // エリアとジャンルのリレーションをロード

    // エリアでフィルタリング
    if ($area_id) {
        $query->where('area_id', $area_id);
    }

    // ジャンルでフィルタリング
    if ($genre_id) {
        $query->where('genre_id', $genre_id);
    }

    // クエリを実行して結果を取得
    $shops = $query->get();

    // 検索結果とエリア、ジャンル情報をビューに渡す
    return view('index', compact('shops', 'areas', 'genres'));
}
}