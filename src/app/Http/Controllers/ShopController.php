<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Models\Evaluation;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::query()
            ->when($request->area_id, function ($query, $area_id) {
                return $query->where('area_id', $area_id);
            })
            ->when($request->genre_id, function ($query, $genre_id) {
                return $query->where('genre_id', $genre_id);
            })
            ->when($request->keyword, function ($query, $keyword) {
                return $query->where('name', 'like', "%{$keyword}%");
            })
            ->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('shops.index', [
            'shops' => $shops,
            'areas' => $areas,
            'genres' => $genres,
            'keyword' => $request->keyword,
        ]);

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

        $reviews = Evaluation::where('shop_id', $shop_id)
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('shops.detail', compact('shop', 'reviews'));
    }

    public function store(ReservationRequest $request, $shop_id)
    {
        $user = auth()->user();
        $shop = Shop::findOrFail($shop_id);

        $exists = Reservation::where('user_id', auth()->id())
            ->where('shop_id', $shop_id)
            ->where('date', $request->date)
            ->exists();

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

    public function done()
    {
        return view('shops.done');
    }
}
