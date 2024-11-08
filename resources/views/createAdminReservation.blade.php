<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約作成画面</title>
</head>
<body>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<form action="/admin/reservations" method="POST" class="form-horizontal">
@csrf
    <table>
        <tr>
            <th>映画作品</th>
            <td><input type="text" name="movie_id" value="{{ old('movie_id') }}" /></td>
        </tr>
        <tr>
            <th>上映スケジュール</th>
            <td><input type="text" name="schedule_id" value="{{ old('schedule_id') }}" /></td>
        </tr>
        <tr>
            <th>座席</th>
            <td><input type="text" name="sheet_id" value="{{ old('sheet_id') }}" /></td>
        </tr>
        <tr>
            <th>予約者メールアドレス</th>
            <td><input type="text" name="email" value="{{ old('email') }}" /></td>
        </tr>
        <tr>
            <th>予約者氏名</th>
            <td><input type="text" name="name" value="{{ old('name') }}" /></td>
        </tr>
    </table>
    <p><input type="submit"></p>
</form>
</body>
</html>