<div style="margin: 0 auto;">
  <h1 style="font-size:18px;">ご予約当日のお知らせ</h1>

  <p>{{ $reservation->user->name }}様</p>

  <p>本日はご予約の日です。ご来店お待ちしております。</p>

  <hr>
  <p>【ご予約内容】</p>
  <ul>
    <li><strong>店名:{{ $shop->name }}</strong></li>
    <li>日付:{{ $reservation->date }}</li>
    <li>時間:{{ $reservation->time }}</li>
    <li>人数:{{ $reservation->number }}名</li>
  </ul>
  <hr>

  <p>※お心当たりがない場合はお手数ですがご連絡ください</p>
</div>