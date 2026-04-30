@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/owners/list.css') }}">
@endsection


@section('content')
  <div class="list-content">
    <div class="list-content__inner">
      <h2 class="list-content__heading">店舗一覧</h2>
      <div class="list-content__table">
        <table class="list-table">
          <tr class="list-table__row">
            <th class="list-table__header">店舗名</th>
            <th class="list-table__header">エリア</th>
            <th class="list-table__header">ジャンル</th>
            <th class="list-table__header">登録した日</th>
            <th class="list-table__header">編集</th>
          </tr>
          @forelse ($shops as $shop)
            <tr class="list-table__row">
              <td class="list-table__data">{{ $shop->name }}</td>
              <td class="list-table__data">{{ $shop->area->name }}</td>
              <td class="list-table__data">{{ $shop->genre->name }}</td>
              <td class="list-table__data">{{ $shop->created_at->format('Y/m/d') }}</td>
              <td class="list-table__data">
                <a href="{{ route('owners.edit', ['id' => $shop->id]) }}" class="edit-link">編集する</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">登録されている店舗はありません</td>
            </tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
@endsection