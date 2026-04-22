@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/owners/index.css') }}" />
@endsection

@section('content')
  <div class="shop-create__content">
    <div class="shop-create__inner">
      <h2 class="shop-create__title">店舗情報登録</h2>
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
      <form class="shop-create__form" action="{{ route('owners.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="shop-create__top">
          <div class="shop-create__left">
            <label class="shop-create__box">
              <span class="shop-create__btn">画像を選択する</span>
              <input class="shop-create__image" type="file" name="image" hidden>
            </label>
            @error('image')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="shop-create__right">
            <label class="shop-create__shop" for="name">店舗名</label>
            <input class="shop-create__name" name="name" type="text" />
            @error('name')
              <p class="error-message">{{ $message }}</p>
            @enderror
            <label class="shop-create__heading" for="area">エリア</label>
            <select class="shop-create__select" name="area">
              <option value="" disabled selected>選択してください</option>
              @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
              <span class="select-icon"></span>
            </select>
            @error('area')
              <p class="error-message">{{ $message }}</p>
            @enderror
            <label class="shop-create__heading" for="genre">ジャンル</label>
            <select class="shop-create__select" name="genre">
              <option value="" disabled selected>選択してください</option>
              @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
              @endforeach
              <span class="select-icon"></span>
            </select>
            @error('genre')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="shop-create__description">
          <label class="description-label" for="shop_overview">店舗概要:</label>
          <textarea name="shop_overview" id="shop_overview"></textarea>
        </div>
        @error('shop_overview')
          <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="shop-create__menus">
          <label class="shop-create__menu" for="price_name">メニュー:</label>
          <input class="menu-input" type="text" name="price_name" id="price_name">
        </div>
        @error('price_name')
          <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="shop-create__prices">
          <label class="shop-create__price" for="price">価格:</label>
          <span class="yen-icon">¥</span>
          <input class="price-input" type="number" name="price" id="price">
        </div>
        @error('price')
          <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="create-button">
          <button class="create-btn" type="submit">作成する</button>
        </div>
    </div>
    </form>
  </div>
  </div>
@endsection