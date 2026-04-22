@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/owners/edit.css') }}" />
@endsection

@section('content')
  <div class="edit-content">
    <div class="edit-content__inner">
      <h2 class="edit-content__heading">店舗一覧</h2>
      <div class="edit-content__table">
        <table class="edit-table">
          <tr class="edit-table__row">
            <th class="edit-table__header">店舗名</th>
            <th class="edit-table__header">エリア</th>
            <th class="edit-table__header">ジャンル</th>
            <th class="edit-table__header">登録した日</th>
          </tr>
          <tr class="edit-table__row">
            <td class="edit-table__data"></td>
            <td class="edit-table__data"></td>
            <td class="edit-table__data"></td>
            <td class="edit-table__data"></td>
          </tr>
        </table>
      </div>
      <div class="edit-content__top">
        <h3 class="edit-content__header">店舗情報更新フォーム</h3>
        <form class="edit-form">
          <div class="edit-content__left">
            <img src="" alt="">
          </div>
          <div class="edit-content__right">
            <label class="edit-content__label">店舗名</label>
            <input class="edit-content__data shop-name" type="text" value=""></input>
            <label class="edit-content__label">エリア</label>
            <select name="area" class="edit-content__data shop-area">
              <option value="" disabled selected>選択してください</option>
              <option value=""></option>
              <span class="select-icon"></span>
            </select>
            <label class="edit-content__label">ジャンル</label>
            <select name="genre" class="edit-content__data shop-genre">
              <option value="" disabled selected>選択してください</option>
              <option value=""></option>
              <span class="select-icon"></span>
            </select>
          </div>
          <div class="edit-content__group">
            <label class="edit-content__title" for="shop-overview">店舗概要</label>
            <textarea class="edit-content__data shop-overview" name="shop_overview" id="shop-overview"></textarea>
          </div>
          <div class="edit-content__group">
            <label class="edit-content__title" for="price_name">メニュー</label>
            <input class="edit-content__data shop-price_name" name="price_name" id="price_name"></input>
          </div>
          <div class="edit-content__group">
            <label class="edit-content__title" for="price">価格</label>
            <p class="edit-content__data shop-price" name="price" id="price"></p>
          </div>
          <div class="edit-content__button">
            <button class="edit-content__btn" type="submit">更新する</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection