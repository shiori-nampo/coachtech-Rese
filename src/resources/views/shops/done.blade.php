@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/shops/done.css') }}" />
@endsection


@section('content')
  <div class="done-wrapper">
    <div class="done-wrapper__box">
      <p class="done-wrapper__message">ご予約ありがとうございます</p>
      <div class="done-wrapper__button">
        <a class="done-wrapper__btn" href="{{ route('shops.index') }}">戻る</a>
      </div>
    </div>
  </div>
@endsection