@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage/change.css') }}" />
@endsection


@section('content')
  <div class="change-content">
    <div class="reservation-change__content">
      <h3 class="change-title">予約変更: {{ $reservation->shop->name }}</h3>
      <form class="change-form" action="{{ route('mypage.update', ['reservation_id' => $reservation->id]) }}"
        method="post">
        @method('PATCH')
        @csrf
        <div class="change-select">
          <input class="reservation-date" type="date" name="date" id="date-input"
            value="{{ $reservation ? $reservation->date : old('date') }}">
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
        <div class="change-select">
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
        <div class="reservation-button">
          <button class="reservation-btn" type="submit">変更する</button>
        </div>
      </form>
    </div>
  </div>
  </div>
@endsection