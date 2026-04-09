@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('content')
  <div class="login-form">
    <div class="login-form__box">
      <div class="login-title">
        <p class="login-form__ttl">Login</p>
      </div>
      <form class="login-form__form" action="{{ route('login') }}" method="post">
        @csrf
        <div class="login-form__group">
          <label class="name-icon" for="email">✉️</label>
          <input class="login-form__data" name="email" id="email" placeholder="Email">
        </div>
        <p class="error-message">
          @error('email')
            {{ $message }}
          @enderror
        </p>
        <div class="login-form__group">
          <label class="name-icon" for="password">🔒</label>
          <input class="login-form__data" name="password" id="password" placeholder="Password">
        </div>
        <p class="error-message">
          @error('password')
            {{ $message }}
          @enderror
        </p>
        <div class="login-form__button">
          <button class="login-form__btn" type="submit">ログイン</button>
        </div>
      </form>
    </div>
  </div>
@endsection