<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@foreach ($movies as $movie)
    @if ($movie->schedules->isNotEmpty())
        <h2><a href="/admin/movies/{{ $movie->id }}">{{ $movie->id }}：{{ $movie->title }}</a></h2>
        <p>@foreach ($movie->schedules as $schedule)    
        <a href="/admin/schedules/{{ $schedule->id }}">{{ $schedule->start_time->format('H:i') }}〜{{ $schedule->end_time->format('H:i') }}</a><br>
        @endforeach</p>
        <p><a href="/admin/movies/{{ $movie->id }}/schedules/create">新規登録</a></p>
    @endif
@endforeach
</body>
</html>