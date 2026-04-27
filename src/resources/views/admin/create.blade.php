@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}" />
@endsection


@section('content')
  <div class="owners-create__form">
    <div class="owners-create__inner">
      <h2 class="owners-create__heading">Owner Register</h2>
      <form class="owners-form" action="{{ route('admin.store') }}" method="post">
        @csrf
        <div class="owners-form__group">
          <label class="owners-form__label" for="name">👤</label>
          <input class="owners-form__input" type="text" id="name" name="name" placeholder="Username">
        </div>
        <p class="error-message">
          @error('name')
            {{ $message }}
          @enderror
        </p>
        <div class="owners-form__group">
          <label class="owners-form__label" for="email">✉️</label>
          <input class="owners-form__input" type="email" id="email" name="email" placeholder="Email">
        </div>
        <p class="error-message">
          @error('email')
            {{ $message }}
          @enderror
        </p>
        <div class="owners-form__group">
          <label class="owners-form__label" for="password">🔒</label>
          <input class="owners-form__input" type="password" id="password" name="password" placeholder="Password">
        </div>
        <p class="error-message">
          @error('password')
            {{ $message }}
          @enderror
        </p>
        <div class="owners-form__button">
          <button class="owners-form__btn" type="submit">登録</button>
        </div>
      </form>
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
    </div>
  </div>
@endsection