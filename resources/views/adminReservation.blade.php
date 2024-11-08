<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation</title>
</head>
<body>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
    <table>
        <tr>
            <th></th>
            <th>映画作品</th>
            <th>座席</th>
            <th>スクリーン</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
        @foreach ($reservations as $reservation)
        <tr>
            <td>
                <a href="/admin/reservations/{{ $reservation->id }}/edit">編集</a>
            </td>
            <td>{{ $reservation->schedule->movie->title }}</td>
            <td>{{ strtoupper($reservation->sheet->row) }}{{ $reservation->sheet->column }}</td>
            <td>{{ $reservation->schedule->screen->screen }}</td>
            <td>{{ $reservation->date }} {{ $reservation->schedule->start_time->format('H:i') }}〜{{ $reservation->schedule->end_time->format('H:i') }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->email }}</td>
        </tr>
        @endforeach
    </table>
    <p><a href="/admin/reservations/create">新規登録</a></p>
</body>
</html>