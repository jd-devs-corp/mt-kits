<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $fileName }}</title>
    <link rel="stylesheet" href="{{ public_path('pdf.css') }}" type="text/css">
    <link rel="shortcut icon" href="{{ public_path('images/logo_admin.png') }}" type="image/x-icon">
    <style type="text/css" media="all">
       @font-face {
            font-family: 'Sora';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Sora.ttf') }}) format('truetype');
        } @font-face {
            font-family: 'Montserrat';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Montserrat.ttf') }}) format('truetype');
        }
        @font-face {
            font-family: 'Montserrat Italic';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Montserrat-Italic.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Poppins-Regular.ttf') }}) format('truetype');
        }
        body{
            font-family: "Poppins", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana;
            outline: none;
        }
        /* * {
            font-family: DejaVu Sans, sans-serif !important;
        }

        html{
            width:100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            border-radius: 10px 10px 10px 10px;
        }

        table td,
        th {
            border-color: #ededed;
            border-style: solid;
            border-width: 1px;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        } */

        table th {
            font-weight: normal;
        }

    </style>
</head>
<body>
<div class="margin-top">
    <table class="products">
        <tr>
            @foreach ($columns as $column)
                <th>
                    {{ $column->getLabel() }}
                </th>
            @endforeach
        </tr>
        <input type="hidden" {{$inc = 0}} >
        @foreach ($rows as $row)
        <tr class="@if ($inc % 2 == 0)
        items
        @endif
        "
        >
            @foreach ($columns as $column)
            <td>
                {{ $row[$column->getName()] }}
            </td>
            @endforeach
        </tr>
        <input type="hidden" {{$inc++}} >
        @endforeach
    </table>
</div>
</body>
</html>
