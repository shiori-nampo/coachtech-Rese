<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Evaluation;


class EvaluationController extends Controller
{
    public function show()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->whereNotNull('checked_in')
            ->with('shop')
            ->latest('date')
            ->paginate(5);

        $reservations->each(function ($reservation) {
            $reservation->total_price = $reservation->getTotalPrice();
        });

        return view('mypage.evaluations', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required',
            'star' => 'required',
            'content' => 'required',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if (!$reservation) {
            return back()->with('error', '予約データが見つかりませんでした');
        }



        Evaluation::create([
            'user_id' => auth()->id(),
            'reservation_id' => $request->reservation_id,
            'shop_id' => $reservation->shop_id,
            'star' => $request->star,
            'content' => $request->content,
        ]);

        return back()->with('success', 'レビューを投稿しました');
    }
}
