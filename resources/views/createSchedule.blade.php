<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録画面</title>
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
<form action="store" method="POST" class="form-horizontal">
@csrf
<p>movie_id：<input type="text" name="movie_id" value="{{ $movie_id }}"></p>
    <p>開始日付：<input type="date" name="start_time_date">　開始時間：<input type="time" name="start_time_time"></p>
    <p>終了日付：<input type="date" name="end_time_date">　終了時間：<input type="time" name="end_time_time"></p>
    <p><input type="submit"></p>
</form>
</body>
</html>