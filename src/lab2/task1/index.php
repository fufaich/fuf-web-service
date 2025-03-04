<?php
session_start();
ob_start(); // Начало буферизации вывода

// Функции для обработки действий
function generateMultiplicationTable($n = 10) {
    echo "<table border='1' style='text-align:center;'>";
    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $n; $j++) {
            $result = $i * $j;
            $color = ($result % 2 == 0) ? 'green' : 'yellow';
            echo "<td style='background-color: $color;'>$result</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function sumOddNumbers($max) {
    $sum = 0;
    $output = "<table border='1'><tr>";
    $count = 0;
    for ($i = 1; $i <= $max; $i += 2) {
        $sum += $i;
        $output .= "<td>$i</td>";
        $count++;
        if ($count % 10 == 0) $output .= "</tr><tr>";
    }
    $output .= "</tr></table><p>Сумма нечетных чисел: $sum</p>";
    echo $output;
}

function handleFileAction($action, $studentNumber) {
    $filename = "data.txt";
    if ($action === 'create') {
        $n = $studentNumber;
        $content = "";
        for ($i = 1; $i <= $n; $i++) {
            $content .= "Строка $i\n";
        }
        file_put_contents($filename, $content);
        echo "Файл с $n строками создан.";
    } elseif ($action === 'add') {
        $n = $studentNumber;
        $content = "";
        for ($i = 1; $i <= $n; $i++) {
            $content .= "Добавочная строка $i\n";
        }
        file_put_contents($filename, $content, FILE_APPEND);
        echo "Текст добавлен в файл.";
    } elseif ($action === 'read') {
        echo nl2br(file_get_contents($filename));
    } elseif ($action === 'update') {
        file_put_contents($filename, "Бальмин М.А. 1144\n", FILE_APPEND);
        echo "Фамилия и группа добавлены в файл.";
    }
}

function translateWord($word) {
    $dictionary = [
        'cat' => 'кот',
        'dog' => 'собака'
    ];
    return $dictionary[strtolower($word)] ?? 'Перевод не найден';
}

$output = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task'])) {
        $_SESSION['task'] = $_POST['task']; // Сохраняем выбор задачи в сессию
        ob_start();
        if ($_POST['task'] === 'multiplication') {
            generateMultiplicationTable();
        } elseif ($_POST['task'] === 'sum_odds') {
            sumOddNumbers(rand(20, 100));
        } elseif ($_POST['task'] === 'translate' && isset($_POST['word'])) {
            echo "<p>Перевод: " . translateWord($_POST['word']) . "</p>";
        }
        $output = ob_get_clean();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['file_action']) && isset($_GET['student_number'])) {
    ob_start();
    handleFileAction($_GET['file_action'], $_GET['student_number']);
    $output = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор задачи</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
    <script>
        function toggleTranslationField() {
            var taskSelect = document.getElementById("task");
            var translationField = document.getElementById("translationField");
            translationField.style.display = taskSelect.value === "translate" ? "block" : "none";
        }
        window.onload = function() {
            // Сохраняем выбранную задачу при перезагрузке страницы
            var selectedTask = "<?php echo isset($_SESSION['task']) ? $_SESSION['task'] : 'multiplication'; ?>";
            document.getElementById('task').value = selectedTask;
            toggleTranslationField(); // Открываем поле перевода, если выбрано
        }
    </script>
</head>
<body>
<table>
    <tr>
        <th>Работа с циклическими структурами</th>
        <th>Работа с файлом</th>
    </tr>
    <tr>
        <td>
            <form method="post">
                <select name="task" id="task" onchange="toggleTranslationField()">
                    <option value="multiplication">Таблица умножения</option>
                    <option value="sum_odds">Сумма нечетных чисел</option>
                    <option value="translate">Переводчик</option>
                </select>
                <button type="submit">ОК</button>
            </form>
            <form method="post" id="translationField" style="display:none;">
                <input type="hidden" name="task" value="translate">
                <label>Введите слово: <input type="text" name="word"></label>
                <button type="submit">Перевести</button>
            </form>
        </td>
        <td>
            <form method="get">
                <label>N:</label>
                <input type="number" name="student_number" min="1">
                <br>
                <input type="radio" name="file_action" value="create"> Создать файл <br>
                <input type="radio" name="file_action" value="add"> Добавить текст <br>
                <input type="radio" name="file_action" value="read"> Вывести содержимое <br>
                <input type="radio" name="file_action" value="update"> Добавить фамилию и группу <br>
                <button type="submit">Выполнить</button>
            </form>
        </td>
    </tr>
</table>
</body>
<div id="result"> <?php echo $output; ?> </div>
</html>