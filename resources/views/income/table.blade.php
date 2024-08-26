<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    
    <table>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Value</th>
        </tr>
        @foreach ($data as $date => $items)
            <tr>
                <td rowspan="{{ $items->count() }}">{{ $date }}</td>
                <td>{{ $items->first()->category }}</td>
                <td>{{ $items->first()->value }}</td>
            </tr>
            @foreach ($items->slice(1) as $item)
                <tr>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->value }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
    
    
</body>
</html>
