@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/owners/confirm.css') }}">
@endsection


@section('content')
  <div class="confirm-content">
    <div class="confirm-content__inner">
      <h2 class="confirm-header">予約確認</h2>
      <input class="confirm-date" name="date" id="reservation_date" value="{{ date('Y-m-d') }}" type="date">
      <div class="confirm-group">
        <table class="confirm-table">
          <thead>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">日付</th>
              <th class="confirm-table__header">時間</th>
              <th class="confirm-table__header">人数</th>
              <th class="confirm-table__header">金額</th>
              <th class="confirm-table__header">ユーザー名</th>
            </tr>
          </thead>
          <tbody id="reservation_list">
            @forelse ($reservations as $res)
              <tr class="confirm-table__row">
                <td class="confirm-table__data">{{ \Carbon\Carbon::parse($res->date)->format('Y-m-d') }}</td>
                <td class="confirm-table__data">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}</td>
                <td class="confirm-table__data">{{ $res->number }}</td>
                <td class="confirm-table__data">{{ number_format($res->total_price) }}円</td>
                <td class="confirm-table__data">{{ $res->user->name }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5">今日の予約はありません</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('reservation_date');
    const tableBody = document.getElementById('reservation_list');

    if (!dateInput) {
      console.error('Error: reservation_date が見つかりません');
      return;
    }

    dateInput.addEventListener('change', function () {
      const selectedDate = this.value;
      console.log('選択された日付:', selectedDate);

      tableBody.innerHTML = '<tr><td colspan="5">検索中...</td></tr>';

      fetch(`/owners/reservation/search?date=${selectedDate}`)
        .then(response => {
          if (!response.ok) throw new Error('通信エラー');
          return response.json();
        })
        .then(data => {
          tableBody.innerHTML = '';

          if (data.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="5">予約はありません</td></tr>';
            return;
          }

          data.forEach(res => {

            const time = res.time ? res.time.substring(0, 5) : '--:--';

            const row = `
        <tr class="confirm-table__row">
          <td class="confirm-table__data">${selectedDate}</td>
          <td class="confirm-table__data">${time}</td>
          <td class="confirm-table__data">${res.number}</td>
          <td class="confirm-table__data">${res.total_price.toLocaleString()}円</td>
          <td class="confirm-table__data">${res.user.name}</td >
          </tr >
          `;
            tableBody.insertAdjacentHTML('beforeend', row);
          });
        })
        .catch(error => {
          console.error('Error:', error);
          tableBody.innerHTML = '<tr><td colspan="5">読み込みに失敗しました</td></tr>';

        });
    });
  });
</script>