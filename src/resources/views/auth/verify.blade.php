@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}" />
@endsection


@section('content')
  <div class="email-content">
    <div class="email-content__box">
      <h2 class="email-content__heading">ご登録いただいたメールアドレスに認証メールを送付しました。<br>メール認証を完了させてください。</h2>
      <a class="email-content__link" href="{{ config('app.mailhog_url') }}" target="_blank" rel="noopener">認証はこちらから</a>
    </div>
    <form class="email-content__form" method="post" action="{{ route('verification.send') }}">
      @csrf
      <button class="email-content__btn" type="submit">認証メールを再送する</button>
      @if (session('status') === 'verification-link-sent')
        <div class="email-content__message">認証メールを再送しました。
        </div>
      @endif
    </form>
  </div>
@endsection