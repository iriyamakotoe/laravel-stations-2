<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理画面映画詳細</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>管理者：映画詳細画面</h1>
    <h1>{{ $movie->title }}</h1>
    <table>
        <tr>
            <th>ジャンル</th>
            <td>{{ $movie->genre ? $movie->genre->name : 'ジャンルなし' }}</td>
        </tr>
        <tr>
            <th>画像URL</th>
            <td><img src="{{ $movie->image_url }}" alt=""></td>
        </tr>
        <tr>
            <th>公開年</th>
            <td>{{ $movie->published_year }}</td>
        </tr>
        <tr>
            <th>上映中かどうか</th>
            <td>@if ($movie->is_showing) 上映中
                @else 上映予定
                @endif</td>
        </tr>
        <tr>
            <th>概要</th>
            <td>{{ $movie->description }}</td>
        </tr>
        <tr>
            <th>スケジュール</th>
            <td>
            @foreach ($movie->schedules as $schedule)    
            <a href="/admin/schedules/{{ $schedule->id }}">{{ $schedule->start_time->format('Y-m-d H:i:s') }}〜{{ $schedule->end_time->format('Y-m-d H:i:s') }}</a><br>
            @endforeach
            <p><a href="/admin/movies/{{ $movie->id }}/schedules/create">新規登録</a></p>
            </td>
        </tr>
    </table>

</body>
</html>