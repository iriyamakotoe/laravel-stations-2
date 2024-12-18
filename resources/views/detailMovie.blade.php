<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画詳細</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>映画詳細画面</h1>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('duplicate'))
    <div class="alert alert-danger">
        {{ $errors->first('duplicate') }}
    </div>
@endif

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
            {{ $schedule->start_time->format('H:i') }}〜{{ $schedule->end_time->format('H:i') }} <a href="/movies/{{$movie->id}}/schedules/{{$schedule->id}}/sheets?date={{$today}}">座席を予約する</a><br>
            @endforeach</td>
        </tr>
    </table>
</body>
</html>