@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}" />
@endsection


@section('content')
  <div class="owners-content">
    <div class="owners-content__inner">
      <h2 class="owners-content__heading">店舗代表者一覧</h2>
      <div class="owners-content__page">{{ $owners->links() }}</div>
      <div class="owners-content__table">
        <table class="owners-table">
          <tr class="owners-table__row">
            <th class="owners-table__header">ID</th>
            <th class="owners-table__header">名前</th>
            <th class="owners-table__header">メールアドレス</th>
            <th class="owners-table__header">店舗名</th>
            <th class="owners-table__header">エリア</th>
            <th class="owners-table__header">ジャンル</th>
          </tr>
          @foreach ($owners as $owner)
            <tr class="owners-table__row">
              <td class="owners-table__data">{{ $owner->id }}</td>
              <td class="owners-table__data">{{ $owner->name }}</td>
              <td class="owners-table__data">{{ $owner->email }}</td>
              <td class="owners-table__data">{{ $owner->shops->first()->name ?? '未登録' }}</td>
              <td class="owners-table__data">{{ $owner->shops->first()->area->name ?? '-' }}</td>
              <td class="owners-table__data">{{ $owner->shops->first()->genre->name ?? '-' }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection