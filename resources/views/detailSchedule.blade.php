<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>管理者：スケジュール詳細画面</h1>
<h2>{{ $schedule->start_time }}〜{{ $schedule->end_time }}</h2>
<p><a href="/admin/schedules/{{ $schedule->id }}/edit">編集</a></p>
<form action="/admin/schedules/{{ $schedule->id }}/destroy" method="POST" onsubmit="return confirm('本当に削除しますか？');">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">削除</button>
</form>
</body>
</html>