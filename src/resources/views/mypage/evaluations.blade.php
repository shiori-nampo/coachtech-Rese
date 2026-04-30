@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage/evaluations.css') }}" />
@endsection


@section('content')
  <div class="review-content">
    <div class="review-shop">
      <div class="review-shop__heading">
        <h2 class="review-shop__title">来店したお店</h2>
        <div class="pagination">{{ $reservations->links() }}</div>
      </div>
      @if ($reservations->isEmpty())
        <p>来店済みの履歴はありません</p>
      @else
        <table class="review-shop__table">
          <tr class="review-shop__row">
            <th class="review-shop__header">店名</th>
            <th class="review-shop__header">日付</th>
            <th class="review-shop__header">時間</th>
            <th class="review-shop__header">人数</th>
            <th class="review-shop__header">料金</th>
          </tr>
          @foreach ($reservations as $reservation)
            <tr class="review-shop__row" onclick="selectReservation('{{ $reservation->id }}')" style="cursor: pointer;">
              <td class="review-shop__data">{{ $reservation->shop->name }}</td>
              <td class="review-shop__data">{{ date('Y-m-d', strtotime($reservation->date)) }}</td>
              <td class="review-shop__data">{{ date('H:i', strtotime($reservation->time)) }}</td>
              <td class="review-shop__data">{{ $reservation->number }}</td>
              <td class="review-shop__data">{{ number_format($reservation->total_price) }}円</td>
            </tr>
          @endforeach
        </table>
      @endif
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
    </div>
    <form class="review-shop__form" action="{{ route('review.store') }}" method="post">
      @csrf
      <select class="review-shop__select" name="reservation_id" id="reservation-select">
        <option value="" disabled select>選択してください</option>
        @foreach ($reservations as $reservation)
          <option value="{{ $reservation->id }}">{{ $reservation->shop->name }}
            ({{ date('m/d', strtotime($reservation->date)) }}来店)</option>
        @endforeach
        <span class="select-icon"></span>
      </select>
      <div class="stars">
        <span>
          <input id="star5" type="radio" name="star" value="5"><label for="star5">★</label>
          <input id="star4" type="radio" name="star" value="4"><label for="star4">★</label>
          <input id="star3" type="radio" name="star" value="3"><label for="star3">★</label>
          <input id="star2" type="radio" name="star" value="2"><label for="star2">★</label>
          <input id="star1" type="radio" name="star" value="1"><label for="star1">★</label>
        </span>
      </div>
      <textarea class="review-comment" name="content" row="5" cols="30"></textarea>
      <div class="review-button">
        <button class="review-btn" type="submit">送信する</button>
      </div>
    </form>
  </div>

  <script>
    function selectReservation(id) {
      const select = document.getElementById('reservation-select');

      select.value = id;

      const form = document.querySelector('.review-shop__form');
      setTimeout(() => {
        form.style.backgroundColor = 'transparent';
      }, 500);
    }
  </script>
@endsection