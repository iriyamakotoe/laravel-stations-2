<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール登録画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>管理者：スケジュール登録画面</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<form action="store" method="POST" class="form-horizontal">
@csrf
<p>movie_id：<input type="text" name="movie_id" value="{{ $movie_id }}"></p>
    <p>開始日付：<input type="date" name="start_time_date">　終了日付：<input type="date" name="end_time_date"></p>
    <p>開始時間：<input type="time" name="start_time_time">　終了時間：<input type="time" name="end_time_time"></p>
    <p>スクリーン：<select name="screen_id" id="">
        @foreach ($screens as $screen)
            <option value="{{ $screen->screen }}">{{ $screen->screen }}</option>
        @endforeach   
    </select></p>
    <p><input type="submit"></p>
</form>
</body>
</html>