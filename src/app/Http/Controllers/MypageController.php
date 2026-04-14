<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $reservations = Reservation::with('shop')
            ->where('user_id', $user->id)
            ->get();

        $favorite_shops = Favorite::with('shop.area', 'shop.genre')
            ->where('user_id', $user->id)
            ->get();


        return view('mypage.index', compact('user', 'reservations', 'favorite_shops'));
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::where('user_id', auth()->id())
            ->findOrFail($reservation_id);
        //自分以外の予約は消さない

        $reservation->delete();

        return redirect()->route('mypage.index')->with('success', '予約をキャンセルしました');
    }
}
