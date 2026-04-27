@extends('layouts.app')


@section('css')
  <link rel="stylesheet" href="{{ asset('css/shops/index.css') }}" />
@endsection


@section('content')
  <div class="shop-content">
    <form class="search-form" action="{{ route('shops.index') }}" method="get">
      <div class="search-form__item">
        <select name="area_id"><!--コントローラと名前合わせる-->
          <option value="" disabled selected>All area</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
          @endforeach
        </select>
        <span class="select-icon"></span>
      </div>
      <div class="search-form__item border-center">
        <select name="genre_id">
          <option value="" disabled selected>All genre</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach
        </select>
        <span class="select-icon"></span>
      </div>
      <div class="search-form__item border-left">
        <span class="search-icon">🔍</span>
        <input type="text" name="keyword" placeholder="Search..." />
      </div>
    </form>
    <div class="shop-content__item">
      @foreach ($shops as $shop)
        <div class="shop-content__group">
          <img class="shop-content__image" src="{{ $shop->image }}" alt="{{ $shop->name }}" />
          <h2 class="shop-content__title">{{ $shop->name }}</h2>
          <div class="shop-content__comment">
            <p class="shop-content__area">#{{ $shop->area->name }}</p>
            <p class="shop-content__genre">#{{ $shop->genre->name }}</p>
          </div>
          <div class="shop-content__link">
            <a class="shop-content__detail" href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}">詳しくみる</a>
            <div class="shop-content__heart">
              <form class="shop-heart__form" action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                @csrf
                <button class="shop-heart__btn" type="submit">
                  @if ($shop->is_favorited_by_auth_user())
                    <img class="shop-heart__icon" src="{{ asset('images/heart_pink.png') }}" alt="お気に入り登録" />
                  @else
                    <img class="shop-heart__icon--inactive" src="{{ asset('images/heart_logo.png') }}" alt="お気に入り解除">
                  @endif
                </button>
            </div>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection