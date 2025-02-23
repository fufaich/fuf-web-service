<!DOCTYPE html>
<html>
<head>
    <title>Разветвляющийся алгоритм</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f0f2f5;
            color: #1a1a1a;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin: 30px 0;
            padding-bottom: 10px;
            border-bottom: 3px solid #3498db;
        }
        .example {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #e1e4e8;
            border-radius: 8px;
            background: #fff;
        }
        .example h3 {
            color: #34495e;
            margin-top: 0;
        }
        .example div {
            padding: 8px;
            margin: 5px 0;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .result {
            margin: 20px 0;
            padding: 15px;
            background: #e8f4fd;
            border-radius: 8px;
            border-left: 5px solid #3498db;
            font-weight: bold;
            color: #2c3e50;
        }
        .error {
            background: #fee;
            color: #c0392b;
            padding: 15px;
            border-radius: 8px;
            border-left: 5px solid #e74c3c;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        echo "<h2>Шаг 1: Все примеры</h2>";
        echo "<div class='example'>";
        echo "<h3>1. Повседневная жизнь</h3>";
        echo "<div>Встретил кот - Погладить кота</div>";
        echo "<div>Не встретил кота - Пошёл искать кота дома</div>";
        echo "<div>Кот встретил и мяукает - Погладить кота, насыпать корм</div>";
        echo "</div>";
        echo "<div class='example'>";
        echo "<h3>2. Литературное произведение - Три товарища (Эрих Мария Ремарк)</h3>";
        echo "<div>Поехать на гонки - Выиграть пари, но повредить автомобиль</div>";
        echo "<div>Остаться в баре - Встретить Патрицию Хольман</div>";
        echo "<div>Помочь Ленцу - Попасть в политическую стычку</div>";
        echo "<div>Уехать из города - Потерять связь с друзьями</div>";
        echo "</div>";

        echo "<div class='example'>";
        echo "<h3>3. Обработка HTTP-запроса</h3>";
        echo "<div>GET-запрос - Получить данные с сервера</div>";
        echo "<div>POST-запрос - Создать новый ресурс</div>";
        echo "<div>PUT-запрос - Обновить существующий ресурс</div>";
        echo "<div>DELETE-запрос - Удалить ресурс</div>";
        echo "<div>PATCH-запрос - Частичное обновление ресурса</div>";
        echo "</div>";

        $selectedExample = rand(1, 3);
        echo "<h2>Шаг 2: Выбранный пример</h2>";
        echo "<div class='result'>";
        echo "Выбран пример {$selectedExample}";
        echo "</div>";
        $studentNumber = rand(1, 3);
        $selectedAction = rand(1, 4);
        
        echo "<h2>Шаг 3: Выбранное действие</h2>";
        echo "<div class='result'>";
        echo "Студент №$studentNumber (" . ($studentNumber % 2 == 0 ? 'четный' : 'нечетный') . ")<br>";
        $result = '';
        if ($selectedExample == 1) {
            if ($selectedAction == 1) $result = "Встретил кот - Погладить кота";
            elseif ($selectedAction == 2) $result = "Не встретил кота - Пошёл искать кота дома";
            else $result = "Кот встретил и мяукает - Погладить кота, насыпать корм";
        }
        elseif ($selectedExample == 2) {
            switch($selectedAction) {
                case 1: $result = "Поехать на гонки - Выиграть пари, но повредить автомобиль"; break;
                case 2: $result = "Остаться в баре - Встретить Патрицию Хольман"; break;
                case 3: $result = "Помочь Ленцу - Попасть в политическую стычку"; break;
                default: $result = "Уехать из города - Потерять связь с друзьями";
            }
        }
        else {
            if ($studentNumber % 2 == 0) {
                // Четный номер - используем SWITCH
                switch($selectedAction) {
                    case 1: $result = "GET-запрос - Получить данные с сервера"; break;
                    case 2: $result = "POST-запрос - Создать новый ресурс"; break;
                    case 3: $result = "PUT-запрос - Обновить существующий ресурс"; break;
                    case 4: $result = "DELETE-запрос - Удалить ресурс"; break;
                    default: $result = "PATCH-запрос - Частичное обновление ресурса"; break;
                }
            } else {
                if ($selectedAction == 1) {
                    $result = "GET-запрос - Получить данные с сервера";
                } elseif ($selectedAction == 2) {
                    $result = "POST-запрос - Создать новый ресурс";
                } elseif ($selectedAction == 3) {
                    $result = "PUT-запрос - Обновить существующий ресурс";
                } elseif ($selectedAction == 4) {
                    $result = "DELETE-запрос - Удалить ресурс";
                } else {
                    $result = "PATCH-запрос - Частичное обновление ресурса";
                }
            }
        }
        echo "Выбрано действие: $result";
        echo "</div>";
        ?>
    </div>
</body>
</html>