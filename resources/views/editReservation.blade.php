<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約編集画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>管理者：予約編集画面</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<form action="/admin/reservations/{{ $reservation->id }}" method="POST" class="form-horizontal">
@method('PATCH')
@csrf
    <table>
        <tr>
            <th>映画作品</th>
            <td><input type="text" name="movie_id" value="{{ $reservation->schedule->movie->id }}" /></td>
        </tr>
        <tr>
            <th>上映スケジュール</th>
            <td><input type="text" name="schedule_id" value="{{ $reservation->schedule->id }}" /></td>
        </tr>
        <tr>
            <th>座席</th>
            <td><input type="text" name="sheet_id" value="{{ $reservation->sheet->id }}" /></td>
        </tr>
        <tr>
            <th>予約者メールアドレス</th>
            <td><input type="text" name="email" value="{{ $reservation->email }}" /></td>
        </tr>
        <tr>
            <th>予約者氏名</th>
            <td><input type="text" name="name" value="{{ $reservation->name }}" /></td>
        </tr>
    </table>
    <p><input type="submit"></p>
</form>
<form action="/admin/reservations/{{ $reservation->id }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">削除</button>
</form>
</body>
</html>