@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/shops/detail.css') }}" />
@endsection


@section('content')
  <div class="detail-content">
    <div class="detail-content__shop">
      <div class="detail-shop__header">
        <a class="back-btn" href="{{ route('shops.index') }}">＜</a>
        <h2 class="shop-title">{{ $shop->name }}</h2>
      </div>
      <img class="shop-image" src="{{ $shop->image }}" alt="{{ $shop->name }}">
      <div class="shop-comment">
        <p class="shop-area">#{{ $shop->area->name }}</p>
        <p class="shop-genre">#{{ $shop->genre->name }}</p>
      </div>
      <p class="shop-description">{{ $shop->shop_overview }}</p>
    </div>
    <div class="detail-content__reservation">
      <h3 class="reservation-title">予約</h3>
      <form class="reservation-form" action="{{ route('shops.store', ['shop_id' => $shop->id]) }}" method="post">
        @csrf
        <div class="reservation-select">
          <input class="reservation-date" type="date" name="date" id="date-input">
          @error('date')
            <p class="error-message">{{ $message }}</p>
          @enderror
          <select class="reservation-time" name="time" id="time-input">
            <option value="" disabled selected>選択してください</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
          </select>
          <span class="select-icon"></span>
        </div>
        @error('time')
          <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="reservation-select">
          <select class="reservation-number" name="number" id="number-input">
            <option value="" disabled selected>選択してください</option>
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
            <option value="5">5人</option>
            <option value="6">6人</option>
          </select>
          <span class="select-icon"></span>
        </div>
        @error('number')
          <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="reservation-confirm">
          <div class="reservation-group">
            <p class="reservation-title">Shop</p>
            <p class="reservation-data">{{ $shop->name }}</p>
          </div>
          <div class="reservation-group">
            <p class="reservation-title">Date</p>
            <p class="reservation-data confirm__date" id="confirm-date"></p>
          </div>
          <div class="reservation-group">
            <p class="reservation-title">Time</p>
            <p class="reservation-data confirm__time" id="confirm-time"></p>
          </div>
          <div class="reservation-group">
            <p class="reservation-title">Number</p>
            <p class="reservation-data confirm__number" id="confirm-number"></p>
          </div>
        </div>
        <div class="reservation-button">
          <button class="reservation-btn" type="submit">予約する</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const dateInput = document.getElementById('date-input');
    const timeInput = document.getElementById('time-input');
    const numberInput = document.getElementById('number-input');

    const confirmDate = document.getElementById('confirm-date');
    const confirmTime = document.getElementById('confirm-time');
    const confirmNumber = document.getElementById('confirm-number');

    dateInput.addEventListener('change', () => {
      confirmDate.textContent = dateInput.value;
    });

    timeInput.addEventListener('change', () => {
      confirmTime.textContent = timeInput.value;
    });

    numberInput.addEventListener('change', () => {
      confirmNumber.textContent = numberInput.value + '人';
    });
  </script>

@endsection