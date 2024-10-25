<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheet</title>
</head>
<body>
    <table>
    @foreach ($sheets as $sheet)
        <tr>
            <td style="{{ $sheet->is_reserved ? 'background:#ccc' : '' }}">
            <!-- @if (!$sheet->is_reserved) -->
            <a href="/movies/{{$movie_id}}/schedules/{{$schedule_id}}/reservations/create?date={{$date}}&sheetId={{$sheet ->id}}">
            <!-- @endif -->
            {{ $sheet->row }}-{{ $sheet->column }}
            <!-- @if ($sheet->is_reserved) -->
            </a>
            <!-- @endif -->
    </td>
        </tr>
    @endforeach
    </table>

</body>
</html>