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
    <table>
        <tr>
            <th></th>
            <th>映画タイトル</th>
            <th>ジャンル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td><a href="/admin/movies/{{ $movie->id }}/edit">編集</a>｜
            <form action="/admin/movies/{{ $movie->id }}/destroy" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
            <td><a href="/admin/movies/{{ $movie->id }}">{{ $movie->title }}</a></td>
            <td>{{ $movie->genre ? $movie->genre->name : 'ジャンルなし' }}</td>
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