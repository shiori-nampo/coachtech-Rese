@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin/information.css') }}" />
@endsection

@section('content')
  <div class="information-content">
    <div class="information-content__inner">
      <h2 class="information-header">お知らせ入力フォーム</h2>
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
      <p class="error-message">
        @error('information')
          {{ $message }}
        @enderror
      </p>
      <form class="information-form" action="{{ route('admin.send') }}" method="post">
        @csrf
        <textarea class="information-textarea" name="information"></textarea>
        <div class="information-form__button">
          <button class="information-form__btn">送信する</button>
        </div>
      </form>
    </div>
  </div>
@endsection