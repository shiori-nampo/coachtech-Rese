@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/owners/edit.css') }}" />
@endsection

@section('content')
  <div class="edit-content">
    <div class="edit-content__inner">
      <h2 class="edit-content__header">店舗情報更新フォーム</h2>
      <form class="edit-form" action="{{ route('owners.update', ['id' => $shop->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @error('image')
          <p class="error-message__image">{{ $message }}</p>
        @enderror
        <div class="edit-content__main">
          <div class="edit-content__left">
            @if ($shop->image)
              @if (strpos($shop->image, 'http') === 0)
                <img class="edit-shop__image" src="{{ $shop->image }}" alt="店舗画像">
              @else
                <img class="edit-shop__image" src="{{ Storage::disk('s3')->url($shop->image) }}" alt="店舗画像">
              @endif
            @else
              <p>画像が登録されていません</p>
            @endif
            <div class="upload-area">
              <label class="upload-label">画像を選択
                <input type="file" name="image" class="hidden-input">
              </label>
              <p class="upload-text">※変更する場合のみ選択</p>
            </div>
          </div>
          <div class="edit-content__right">
            <div class="edit-content__group">
              <label class="edit-content__label">店舗名</label>
              <input class="edit-content__data shop-name" type="text" name="name" value="{{ $shop->name }}">
              @error('name')
                <p class="error-message">{{ $message }}</p>
              @enderror
            </div>
            <div class="edit-content__group">
              <label class="edit-content__label">エリア</label>
              <select name="area_id" class="edit-content__data shop-area">
                @foreach($areas as $area)
                  <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>
                    {{ $area->name }}
                  </option>
                @endforeach
              </select>
              @error('area_id')
                <p class="error-message">{{ $message }}</p>
              @enderror
            </div>
            <div class="edit-content__group">
              <label class="edit-content__label">ジャンル</label>
              <select name="genre_id" class="edit-content__data shop-genre">
                @foreach($genres as $genre)
                  <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}
                  </option>
                @endforeach
              </select>
              @error('genre_id')
                <p class="error-message">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        <div class="edit-content__group">
          <label class="edit-content__title" for="shop-overview">店舗概要</label>
          <textarea class="edit-content__data shop-overview" name="shop_overview"
            id="shop-overview">{{ $shop->shop_overview }}</textarea>
          @error('shop-overview')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
        <div class="edit-content__group">
          <label class="edit-content__title" for="price_name">メニュー</label>
          <input class="edit-content__data shop-price_name" name="price_name" id="price_name"
            value="{{ $shop->price_name }}">
          @error('price_name')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
        <div class="edit-content__group">
          <label class="edit-content__title price-name" for="price">価格</label>
          <input class="edit-content__data shop-price" name="price" id="price" value="{{ $shop->price }}">
          @error('price')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>
        <div class="edit-content__button">
          <button class="edit-content__btn" type="submit">更新する</button>
        </div>
      </form>
    </div>
  </div>
@endsection