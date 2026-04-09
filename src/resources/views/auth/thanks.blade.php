@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}" />
@endsection


@section('content')
  <div class="thanks-wrapper">
    <div class="thanks-wrapper__box">
      <p class="thanks-wrapper__message">会員登録ありがとうございます</p>
      <div class="thanks-wrapper__button">
        <button class="thanks-wrapper__btn" type="submit">ログインする</button>
      </div>
    </div>
  </div>
@endsection