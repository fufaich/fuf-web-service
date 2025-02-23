<!DOCTYPE html>
<html>
<head>
    <title>Ассоциативные массивы</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 2000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin: 30px 0 20px;
            font-size: 24px;
            border-bottom: 2px solid#14b42f;
            padding-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #e1e4e8;
            padding: 8px;
            text-align: center;
            font-size: 12.5px;
        }
        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
        }
        td {
            color: #34495e;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .table-2d {
            width: 100%;
        }
        .table-3d {
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // $spaceStations = [
        $spaceStations = [
            'США' => [
                'ISS' => [
                    'год' => 1998,
                    'масса' => '419,725 кг',
                    'орбита' => '408 км',
                    'экипаж' => '7 человек'
                ],
                'Skylab' => [
                    'год' => 1973,
                    'масса' => '77,088 кг', 
                    'орбита' => '435 км',
                    'экипаж' => '3 человека'
                ]
            ],
            'СССР/Россия' => [
                'Мир' => [
                    'год' => 1986,
                    'масса' => '129,700 кг',
                    'орбита' => '390 км',
                    'экипаж' => '3 человека'
                ],
                'Салют-7' => [
                    'год' => 1982,
                    'масса' => '19,824 кг',
                    'орбита' => '219 км',
                    'экипаж' => '2 человека'
                ]
            ]
        ];
        // $astronautCrews = [
        $astronautCrews = [
            'Российская Федерация (Роскосмос)' => [
                'МКС-73 (Союз МС-27)' => [
                    'Сергей Рыжиков' => [
                        'Должность' => 'Командир экспедиции',
                        'Дата запуска' => 'Март 2025',
                        'Статус' => 'Запланировано',
                        'Корабль' => 'Союз МС-27',
                    ],
                    'Алексей Зубрицкий' => [
                        'Должность' => 'Бортинженер',
                        'Дата запуска' => 'Март 2025',
                        'Статус' => 'Запланировано',
                        'Корабль' => 'Союз МС-27',
                    ]
                ],
                'Crew-12 (Dragon)' => [
                    'Олег Артемьев' => [
                        'Должность' => 'Специалист полета',
                        'Дата запуска' => 'I половина 2026', 
                        'Статус' => 'Подготовка',
                        'Корабль' => 'Crew Dragon',
                    ]
                ]
            ],
            
            'США (NASA)' => [
                'Миссия Crew-9' => [
                    'Барри Уилмор' => [
                        'Должность' => 'Специалист полета',
                        'Дата возврата' => '12 Март 2025',
                        'Статус' => 'Возвращение',
                        'Корабль' => 'Crew Dragon',
                    ],
                    'Сунита Уильямс' => [
                        'Должность' => 'Инженер',
                        'Дата возврата' => '12 Март 2025',
                        'Статус' => 'Возвращение',
                        'Корабль' => 'Crew Dragon',
                    ]
                ],
                'Союз МС-28' => [
                    'Кристофер Уилльямс' => [
                        'Должность' => 'Бортинженер',
                        'Дата запуска' => 'Осень 2025',
                        'Статус' => 'Запланировано',
                        'Корабль' => 'Союз МС-28',
                    ]
                ]
            ],
        ];
            
        

        echo "<h2>Двумерный ассоциативный массив</h2>";
        echo "<table class='table-2d'>";
        echo "<tr><th>Регион</th><th>Модель</th><th>Год</th><th>Масса</th><th>Орбита</th><th>Экипаж</th></tr>";
        foreach ($spaceStations as $region => $cars) {
            foreach ($cars as $model => $specs) {
                echo "<tr>";
                echo "<td>$region</td>";
                echo "<td>$model</td>";
                echo "<td>{$specs['год']}</td>";
                echo "<td>{$specs['масса']} л.с.</td>";
                echo "<td>{$specs['орбита']}</td>";
                echo "<td>{$specs['экипаж']}</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<h2>Трехмерный ассоциативный массив</h2>";
        echo "<table class='table-3d'>";
        echo "<tr>";
        foreach ($astronautCrews as $continent => $countries) {
            $colspan = count($countries) * count(reset($countries)) * 4;
            echo "<th colspan='$colspan'>$continent</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($astronautCrews as $countries) {
            foreach ($countries as $country => $brands) {
                $colspan = count($brands) * 4;
                echo "<th colspan='$colspan'>$country</th>";
            }
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($astronautCrews as $countries) {
            foreach ($countries as $brands) {
                foreach ($brands as $brand => $specs) {
                    echo "<th colspan='4'>$brand</th>";
                }
            }
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($astronautCrews as $countries) {
            foreach ($countries as $brands) {
                foreach ($brands as $specs) {
                    foreach ($specs as $key => $value) {
                        echo "<td>$key: $value</td>";
                    }
                }
            }
        }
        echo "</tr>";
        echo "</table>";
        ?>
    </div>
</body>
</html>