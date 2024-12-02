<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約作成画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>予約登録画面</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<form action="/reservations/store" method="POST" class="form-horizontal">
@csrf
<input type="hidden" name="movie_id" value="{{$movie->id}}" />
<input type="hidden" name="schedule_id" value="{{$schedule->id}}" />
<input type="hidden" name="sheet_id" value="{{$sheet->id}}" />
<input type="hidden" name="date" value="{{$date}}" />
    <table>
        <tr>
            <th>映画作品</th>
            <td>{{$movie->title}}</td>
        </tr>
        <tr>
            <th>上映スケジュール</th>
            <td>{{ $schedule->start_time->format('H:i') }}〜{{ $schedule->end_time->format('H:i') }}</td>
        </tr>
        <tr>
            <th>座席</th>
            <td>{{ $sheet->row }}-{{ $sheet->column }}</td>
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