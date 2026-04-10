<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Shop::query();
        $areas = Area::all();
        $genres = Genre::all();
        $keyword = $request->keyword;

        if ($request->area_id) {
            $query->where('area_id', $request->area_id);
        }// whereはどの列かどの値かが必要

        if ($request->genre_id) {
            $query->where('genre_id', $request->genre_id);
        }

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }
        $shops = $query->get();


        return view('shops.index', compact('shops', 'keyword', 'areas', 'genres'));

    }

    public function favorite($shop_id)
    {
        $user = auth()->user();
        $shop = Shop::findOrFail($shop_id);

        $favorite = Favorite::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shop->id
            ]);
        }
        return back();
    }

    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre')->findOrFail($shop_id);

        return view('shops.detail', compact('shop'));
    }

    public function store(Request $request, $shop_id)
    {
        $user = auth()->user();
        $shop = Shop::findOrFail($shop_id);

        //ログイン中のユーザーがすでに予約いていないかチェック
        $exists = Reservation::where('user_id', auth()->id())
            ->where('shop_id', $shop_id)
            ->exists();// 存在するかどうか真偽地で返す

        if ($exists) {
            return back()->with('error', 'この店舗はすでに予約済みです');
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);


        return redirect()->route('shops.done');
    }
}
