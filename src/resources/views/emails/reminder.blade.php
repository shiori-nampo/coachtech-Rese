<div style="margin: 0 auto;">
  <h1 style="font-size:18px;">ご予約当日のお知らせ</h1>

  <p>{{ $reservation->user->name }}様</p>

  <p>本日はご予約の日です。ご来店お待ちしております。</p>

  <p>当日のチェックイン用QRコードです</p>

  @php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
  @endphp


  <div style="margin: 20px 0;">
    <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::encoding('UTF-8')->size(200)->generate(
  '【予約確認】' . "\n" .
  '店名:' . $reservation->shop->name . "\n" .
  '日時: ' . $reservation->date . '' . $reservation->time . "\n" .
  '人数: ' . $reservation->number . '名'
)) !!}">
  </div>

  <hr>
  <p>【ご予約内容】</p>
  <ul>
    <li><strong>店名:{{ $reservation->shop->name }}</strong></li>
    <li>日付:{{ \Carbon\Carbon::parse($reservation->date)->format('Y年m月d日') }}</li>
    <li>時間:{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</li>
    <li>人数:{{ $reservation->number }}名</li>
  </ul>
  <hr>

  <p>※こちらのQRコードを店員にご提示ください</p>

  <p>※お心当たりがない場合はお手数ですがご連絡ください</p>
</div>