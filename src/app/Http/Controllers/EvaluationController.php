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
            ->where('checked_in', true)
            ->with('shop')
            ->latest('date')
            ->paginate(5);

        return view('mypage.evaluations', compact('reservations'));
    }

    public function store(Request $request)
    {
        Evaluation::create([
            'user_id' => auth()->id(),
            'reservation_id' => $request->reservation_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'レビューを投稿しました');
    }
}
