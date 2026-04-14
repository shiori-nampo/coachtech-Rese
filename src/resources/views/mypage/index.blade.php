@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection


@section('content')
  <div class="mypage-content">
    <div class="mypage-content__reservation">
      <h3 class="mypage-reservation__title">予約状況</h3>
      @foreach ($reservations as $index => $reservation)
        <div class="mypage-reservation__box">
          <div class="reservation-box__header">
            <div class="clock-icon"></div>
            <p class="reservation-count">予約{{ $index + 1 }}</p>
            <button class="reservation-cancel" type="submit" form="deleteForm{{ $index }}" value="delete"><span
                class="cancel-btn"></span></button>
          </div>
          <form class="delete-form" action="{{ route('mypage.destroy', ['reservation_id' => $reservation->id]) }}"
            method="post" id="deleteForm{{ $index }}">
            @method('DELETE')
            @csrf
            <div class="reservation-row">
              <p class="reservation-title">Shop</p>
              <p class="reservation-data">{{ $reservation->shop->name }}</p>
            </div>
            <div class="reservation-row">
              <p class="reservation-title">Date</p>
              <p class="reservation-data">{{ date('Y-m-d', strtotime($reservation->date)) }}</p>
            </div>
            <div class="reservation-row">
              <p class="reservation-title">Time</p>
              <p class="reservation-data">{{ date('H:i', strtotime($reservation->time)) }}</p>
            </div>
            <div class="reservation-row">
              <p class="reservation-title">Number</p>
              <p class="reservation-data">{{ $reservation->number }}人</p>
            </div>
          </form>
        </div>
      @endforeach
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
    </div>
    <div class="mypage-content__favorite">
      <h2 class="mypage-user__name">{{ $user->name }}さん</h2>
      <h3 class="favorite-shops">お気に入りの店舗</h3>
      <div class="shop-content__item">
        @foreach ($favorite_shops as $favorite)
          @php $shop = $favorite->shop; @endphp
          <div class="shop-content__group">
            <img class="shop-content__image" src="{{ $shop->image }}" alt="{{ $shop->name }}" />
            <h2 class="shop-content__title">{{ $shop->name }}</h2>
            <div class="shop-content__comment">
              <p class="shop-content__area">#{{ $shop->area->name }}</p>
              <p class="shop-content__genre">#{{ $shop->genre->name }}</p>
            </div>
            <div class="shop-content__link">
              <a class="shop-content__detail" href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}">詳しくみる</a>
              <div class="shop-content__heart">
                <form class="shop-heart__form" action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                  @csrf
                  <button class="shop-heart__btn" type="submit">
                    @if ($shop->is_favorited_by_auth_user())
                      <img class="shop-heart__icon" src="{{ asset('images/heart_pink.png') }}" alt="お気に入り登録" />
                    @else
                      <img class="shop-heart__icon--inactive" src="{{ asset('images/heart_logo.png') }}" alt="お気に入り解除">
                    @endif
                  </button>
              </div>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection