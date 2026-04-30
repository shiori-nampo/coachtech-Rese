<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerCreateRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $areas = Area::all();
        $genres = Genre::all();

        return view('owners.index', compact('areas', 'genres'));
    }

    public function store(OwnerCreateRequest $request)
    {
        $user = auth()->user();

        $path = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('shops', $filename, 's3');
        }

        $shops = Shop::create([
            'user_id' => $user->id,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'name' => $request->name,
            'shop_overview' => $request->shop_overview,
            'image' => $path,
            'price' => $request->price,
            'price_name' => $request->price_name,
        ]);

        return redirect()->route('owners.index')->with('success', '店舗を登録しました');
    }

    public function show()
    {
        $user = auth()->user();

        $shops = Shop::where('user_id', $user->id)
            ->with(['area', 'genre'])
            ->get();

        return view('owners.list', compact('shops'));
    }

    public function edit($id)
    {
        $user = auth()->user();

        $shop = Shop::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $areas = Area::all();
        $genres = Genre::all();

        return view('owners.edit', compact('shop', 'areas', 'genres'));
    }


    public function update(OwnerCreateRequest $request, $id)
    {
        $shop = Shop::findOrFail($id);

        if ($request->hasFile('image')) {
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('shops', $filename, 's3');
            $shop->image = $path;
        }

        $shop->update([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'shop_overview' => $request->shop_overview,
            'price_name' => $request->price_name,
            'price' => $request->price,
        ]);

        $shop->save();

        return redirect()->route('owners.show')->with('success', '店舗情報を更新しました');

    }

    public function confirm()
    {
        $user = auth()->user();

        $today = date('Y-m-d');

        $reservations = Reservation::where('date', $today)
            ->with('user')
            ->get();

        return view('owners.confirm', compact('reservations'));


    }

    public function search(Request $request)
    {
        $date = $request->date;

        $reservations = Reservation::with('user', 'shop')
            ->where('date', $date)
            ->get();

        $reservations->each(function ($reservation) {
            $reservation->total_price = $reservation->getTotalPrice();
        });

        return response()->json($reservations);
    }
}
