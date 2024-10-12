<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        $shops = Shop::with(['area', 'genre'])->get(); // ショップデータを取得
        $favorites = [];

        // ログインしている場合、お気に入りを取得
        if (Auth::check()) {
           $favorites = Auth::user()->favorites->pluck('shop_id')->toArray(); // ユーザーのお気に入りショップIDを配列に変換
        }


        return view('index', compact('shops', 'areas', 'genres', 'favorites'));
    }

    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
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
    $keyword = $request->input('keyword');  // キーワードを取得
    $favorites = $this->getFavorites();

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

    //キーワードでフィルタリング
    if ($keyword) {
        $query->where('name', 'LIKE', "%{$keyword}%")
              ->orWhere('outline', 'LIKE', "%{$keyword}%");  // 店名または説明にキーワードが含まれるか
    }

    // クエリを実行して結果を取得
    $shops = $query->get();

    // 検索結果とエリア、ジャンル情報をビューに渡す
    return view('index', compact('shops', 'areas', 'genres', 'favorites'));
}
}