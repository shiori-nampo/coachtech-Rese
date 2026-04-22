<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerCreateRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;


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
            $path = $request->file('image')->storeAs('shops', $filename, 'public');
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

    public function edit()
    {
        $user = auth()->user();

        $shops = Shop::where('user_id', $user->id)->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('owners.edit', compact('shop', 'areas', 'genres'));
    }
}
