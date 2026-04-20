@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage/evaluations.css') }}" />
@endsection


@section(('content'))
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
            <tr class="review-shop__row">
              <td class="review-shop__data">{{ $reservation->shop->name }}</td>
              <td class="review-shop__data">{{ date('Y-m-d', strtotime($reservation->date)) }}</td>
              <td class="review-shop__data">{{ date('H:i', strtotime($reservation->time)) }}</td>
              <td class="review-shop__data">{{ $reservation->number }}</td>
              <td class="review-shop__data">{{ $reservation->price }}</td>
            </tr>
          @endforeach
        </table>
      @endif
    </div>
    <form class="review-shop__form" action="{{ route('review.store') }}" method="post">
      @csrf
      <select class="review-shop__select" name="reservation_id">
        <option value="" disabled select>選択してください</option>
        @foreach ($reservations as $reservation)
          <option value="{{ $reservation->id }}">{{ $reservation->shop->name }}
            ({{ date('m/d', strtotime($reservation->date)) }}来店)</option>
        @endforeach
        <span class="select-icon"></span>
      </select>
      <div class="stars">
        <span>
          <input id="review01" type="radio" name="stars"><label for="review01">★</label>
          <input id="review02" type="radio" name="stars"><label for="review02">★</label>
          <input id="review03" type="radio" name="stars"><label for="review03">★</label>
          <input id="review04" type="radio" name="stars"><label for="review04">★</label>
          <input id="review05" type="radio" name="stars"><label for="review05">★</label>
        </span>
      </div>
      <textarea class="review-comment" name="comment" row="5" cols="30"></textarea>
      <div class="review-button">
        <button class="review-btn" type="submit">送信する</button>
      </div>
      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
    </form>
  </div>

@endsection