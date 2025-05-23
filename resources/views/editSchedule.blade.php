<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール編集画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>管理者：スケジュール編集画面</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<form action="update" method="POST" class="form-horizontal">
@method('PATCH')
@csrf
<p>movie_id：<input type="text" name="movie_id" value="{{ old('movie_id', $schedule->movie_id) }}"></p>
    <p>開始日付：<input type="date" name="start_time_date" value="{{ old('start_time_date', optional($schedule->start_time)->format('Y-m-d')) }}">　開始時間：<input type="time" name="start_time_time" value="{{ old('start_time_time', optional($schedule->start_time)->format('H:i')) }}"></p>
    <p>終了日付：<input type="date" name="end_time_date" value="{{ old('end_time_date', optional($schedule->end_time)->format('Y-m-d')) }}">　終了時間：<input type="time" name="end_time_time" value="{{ old('end_time_time', $schedule->end_time->format('H:i')) }}"></p>
    <p>スクリーン：<select name="screen_id" id="">
        @foreach ($screens as $screen)
            <option value="{{ $screen->screen }}" @if ($screen->screen == $schedule->screen_id) selected @endif>{{ $screen->screen }}</option>
        @endforeach   
    </select></p>
    <p><input type="submit"></p>
</form>
</body>
</html>