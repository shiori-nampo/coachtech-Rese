@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('content')
  <div class="register-form">
    <div class="register-form__box">
      <div class="register-title">
        <p class="Register-ttl">Registration</p>
      </div>
      <form class="register-form__form">
        <div class="register-form__group">
          <label class="name-icon" for="name">👤</label>
          <input type="text" name="name" id="name" placeholder="Username">
        </div>
        <div class="register-form__group">
          <label class="name-icon" for="email">✉️</label>
          <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="register-form__group">
          <label class="name-icon" for="password">🔒</label>
          <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="register-form__button">
          <button class="register-form__btn" type="submit">登録</button>
        </div>
      </form>
    </div>
  </div>
@endsection