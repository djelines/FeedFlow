<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats du sondage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            background-color: #ffffff;
            line-height: 1.3;
            padding: 15px;
            font-size: 12px;
            margin: 0;
        }

        .header {
            background-color: #333333;
            color: #ffffff;
            padding: 8px 15px;
            margin: -15px -15px 15px -15px;
            font-size: 14px;
            font-weight: bold;
            border-bottom: 3px solid #00bcd4;
        }

        h1 {
            font-size: 18px;
            margin-bottom: 10px;
            padding-bottom: 3px;
            color: #333333;
            border-bottom: 1px solid #cccccc;
            font-weight: bold;
        }

        h3 {
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #00bcd4;
            background-color: #f5f5f5;
            padding: 4px 8px;
            border-radius: 0;
            font-weight: bold;
        }

        .question {
            margin-bottom: 15px;
            padding: 5px;
            border-left: 3px solid #00bcd4;
            background-color: #ffffff;
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin-top: 3px;
        }

        .answer {
            position: relative;
            padding: 2px 5px;
            margin-bottom: 2px;
            color: #444444;
            font-size: 12px;
        }

        .answer::before {
            content: "—";
            color: #aaaaaa;
            font-weight: normal;
            display: inline-block;
            width: 0.8em;
            margin-left: -0.8em;
            font-size: 12px;
            vertical-align: middle;
        }

        .footer {
            margin-top: 20px;
            padding-top: 5px;
            border-top: 1px solid #cccccc;
            text-align: right;
            font-size: 10px;
            color: #777777;
        }

        @media print {
            .header {
                background-color: #ffffff;
                color: #333333;
                border-bottom: 3px solid #00bcd4;
            }
            .question {
                border: 1px solid #dddddd;
                border-left: 3px solid #00bcd4;
                page-break-inside: avoid;
            }
            h3 {
                background-color: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            .answer {
                border-bottom: none;
            }
            .footer {
                border-top: 1px solid #777777;
            }
        }
    </style>
</head>
<body>

<div class="header">Rapport de Résultats du Sondage</div>

<h1>Résultats : {{ $survey->title }}</h1>

@foreach($survey->questions as $q)
    <div class="question">
        <h3>{{ $q->title }}</h3>

        <ul>
            @foreach($q->answers as $ans)
                @php
                    $decoded = json_decode($ans->answer, true);

                    if (!is_array($decoded)) {
                        $decoded = [$ans->answer];
                    }

                    $decoded = array_map(function($v){
                        $v = trim($v);
                        return $v === "" ? "N/A" : $v;
                    }, $decoded);
                @endphp


                @foreach($decoded as $single)
                    <li class="answer">{{ $single }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endforeach

<div class="footer">Généré le {{ date('d-m-Y') }}</div>

</body>
</html>
