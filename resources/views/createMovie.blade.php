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
    <table>
        <tr>
            <th>映画タイトル</th>
            <td><input type="text" name="title" value="{{ old('title') }}" /></td>
        </tr>
        <tr>
            <th>画像URL</th>
            <td><input type="text" name="image_url" value="{{ old('image_url') }}" /></td>
        </tr>
        <tr>
            <th>公開年</th>
            <td><input type="number" name="published_year" value="{{ old('published_year') }}" /></td>
        </tr>
        <tr>
            <th>公開中かどうか</th>
            <td><input type="checkbox" name="is_showing" value="is_showing" />上映中
            <input type="checkbox" name="is_showing" value="not_showing" />上映予定</td>
        </tr>
        <tr>
            <th>概要</th>
            <td><textarea name="description">{{ old('description') }}</textarea></td>
        </tr>
        <tr>
            <th>ジャンル</th>
            <td><input type="text" name="genre" value="{{ old('genre') }}" /></td>
        </tr>
    </table>
    <p><input type="submit"></p>
</form>
</body>
</html>