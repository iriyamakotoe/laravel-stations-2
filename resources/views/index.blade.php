<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <div class="search-box">
        <form action="/movies" method="GET">
            <input type="text" name="keyword" value="{{ request('keyword') }}" />
            <input type="radio" name="is_showing" value="all" {{ $isShowing === null || $isShowing === 'all' ? 'checked' : '' }} />すべて
            <input type="radio" name="is_showing" value="0" {{ $isShowing === '0' ? 'checked' : '' }} />公開予定
            <input type="radio" name="is_showing" value="1" {{ $isShowing === '1' ? 'checked' : '' }}  />公開中
            <input type="submit" value="検索">
        </form>
    </div>
    <table>
    @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->image_url }}</td>
            <td>{{ $movie->published_year }}</td>
            <td>@if ($movie->is_showing) 上映中
                @else 上映予定
                @endif</td>
            <td>{{ $movie->description }}</td>
        </tr>
    @endforeach
    </table>

    <!-- ページネーションリンクを表示 -->
    {{ $movies->links() }}
</body>
</html>