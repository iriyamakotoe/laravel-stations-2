<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <table>
        <tr>
            <th></th>
            <th>映画タイトル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td><a href="movies/{{ $movie->id }}/edit">編集</a></td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->image_url }}</td>
            <td>{{ $movie->published_year }}</td>
            <td>@if ($movie->is_showing) 上映中
                @else 上映予定
                @endif
            </td>
            <td>{{ $movie->description }}</td>
        </tr>
        @endforeach
    </table>
    <p><a href="/admin/movies/create">新規登録</a></p>
</body>
</html>