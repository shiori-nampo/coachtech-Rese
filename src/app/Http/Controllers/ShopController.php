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
}
