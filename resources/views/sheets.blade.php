<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>シート一覧画面</h1>
    <table>
        @php
        $previousRow = null;
    @endphp
    
    @foreach ($sheets as $sheet)
        @if ($sheet->row !== $previousRow)
            <!-- 新しい行を開始 -->
            @if ($previousRow !== null)
                </tr> <!-- 前の行があれば閉じる -->
            @endif
            <tr>
            @php
                $previousRow = $sheet->row;  // 現在の行番号を保存
            @endphp
        @endif
        <td>{{ $sheet->row }}-{{ $sheet->column }}</td>
    @endforeach
    
    <!-- 最後の行を閉じる -->
    @if ($previousRow !== null)
        </tr>
    @endif
    </table>

</body>
</html>