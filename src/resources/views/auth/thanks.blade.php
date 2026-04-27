@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}" />
@endsection


@section('content')
  <div class="thanks-wrapper">
    <div class="thanks-wrapper__box">
      <p class="thanks-wrapper__message">会員登録ありがとうございます</p>
      <div class="thanks-wrapper__button">
        <a class="thanks-wrapper__btn" href="{{ route('login') }}">ログインする</a>
      </div>
    </div>
  </div>
@endsection