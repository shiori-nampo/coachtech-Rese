<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;



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

        $reservation->delete();
        return redirect()->route('mypage.index')->with('success', '予約をキャンセルしました');
    }

    public function edit($reservation_id)
    {
        $reservation = Reservation::with('shop')
            ->findOrFail($reservation_id);
        return view('mypage.edit', compact('reservation'));
    }

    public function update(ReservationRequest $request, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        $reservation->update([
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        return redirect()->route('mypage.index')->with('success', '予約を変更しました');
    }

    public function payment($reservation_id)
    {
        $user = auth()->user();

        $reservation = Reservation::with('shop')->findOrFail($reservation_id);

        if ($reservation->is_paid) {
            return back()->with('error', 'この予約はすでに決済済みです');
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $reservation->shop->name,
                        ],
                        'unit_amount' => $reservation->getTotalPrice(),
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['reservation_id' => $reservation->id]),
            'cancel_url' => route('mypage.index'),
        ]);

        return redirect($session->url);

    }

    public function success($reservation_id)
    {
        $user = auth()->user();

        $reservation = Reservation::findOrFail($reservation_id);

        $reservation->update([
            'is_paid' => true
        ]);

        return redirect()->route('mypage.index')->with('success', '事前決済が完了しました');
    }
}



