<?php
// Получаем номер студента из URL-параметра
$studentNumber = isset($_GET['studentNumber']) ? intval($_GET['studentNumber']) : 0;

// 1. Обновленные примеры согласно image.png
$examples = [
    'Повседневная жизнь' => [
        'Пришёл (а) домой.' => [
            'Встретил кот' => 'Погладить кота',
            'Не встретил кота' => 'Пошёл искать кота дома',
            'Кот встретил и мяукает' => 'Погладить кота, насыпать корм'
        ]
    ],
    'Литературное произведение' => [
        'Три товарища (Эрих Мария Ремарк)' => [
            'Поехать на гонки' => 'Выиграть пари, но повредить автомобиль',
            'Остаться в баре' => 'Встретить Патрицию Хольман',
            'Помочь Ленцу' => 'Попасть в политическую стычку',
            'Уехать из города' => 'Потерять связь с друзьями'
        ]
    ],
    'Информатика' => [
        'Обработка HTTP-запроса' => [
            'GET-запрос' => 'Получить данные с сервера',
            'POST-запрос' => 'Создать новый ресурс',
            'PUT-запрос' => 'Обновить существующий ресурс',
            'DELETE-запрос' => 'Удалить ресурс',
            'PATCH-запрос' => 'Частичное обновление ресурса'
    ]
]

];

// 2. Вывод всех примеров (Шаг 1)
echo '<h2>Шаг 1: Все примеры</h2>';
foreach ($examples as $category => $scenarios) {
    echo "<div class='example'><h3>$category</h3>";
    foreach ($scenarios as $scenario => $options) {
        echo "<div class='scenario'><b>Сценарий: $scenario</b>";
        foreach ($options as $condition => $action) {
            echo "<p>$condition → $action</p>";
        }
        echo '</div>';
    }
    echo '</div>';
}

// 3. Выбор случайного примера (Шаг 2)
$randomCategory = array_rand($examples);
$categoryData = $examples[$randomCategory];
$randomScenario = array_rand($categoryData);
$scenarioData = $categoryData[$randomScenario];

echo '<h2>Шаг 2: Выбранный пример</h2>';
echo "<div class='selected-example'>";
echo "<h3>$randomCategory: $randomScenario</h3>";
foreach ($scenarioData as $condition => $action) {
    echo "<p>$condition → $action</p>";
}
echo '</div>';

// 4. Выбор действия (Шаг 3)
echo '<h2>Шаг 3: Результат выбора</h2>';

if ($studentNumber <= 0) {
    die("<div class='error'>Укажите номер студента в URL: ?studentNumber=ВАШ_НОМЕР</div>");
}

$keys = array_keys($scenarioData);
$randomKey = $keys[array_rand($keys)];
$selectedCondition = $keys[array_rand($keys)];

if ($studentNumber % 2 == 0) {
    // Четный номер - SWITCH
    switch($selectedCondition) {
        case $keys[0]:
            $result = $scenarioData[$keys[0]];
            break;
        case $keys[1]:
            $result = $scenarioData[$keys[1]];
            break;
        case $keys[2]:
            $result = $scenarioData[$keys[2]];
            break;
        default:
            $result = $scenarioData[end($keys)];
    }
} else {
    // Нечетный номер - IF-ELSE
    if ($selectedCondition == $keys[0]) {
        $result = $scenarioData[$keys[0]];
    } elseif ($selectedCondition == $keys[1]) {
        $result = $scenarioData[$keys[1]];
    } else {
        $result = $scenarioData[$keys[2]];
    }
}

echo "<div class='result'>";
echo "<p>Студент №$studentNumber (".($studentNumber%2 == 0 ? 'четный' : 'нечетный').")</p>";
echo "<p>Выбранное условие: <b>$selectedCondition</b></p>";
echo "<p>Результат: <b>$result</b></p>";
echo '</div>';

// Стилизация
echo '<style>
    .example {
        border: 1px solid #ddd;
        padding: 15px;
        margin: 10px;
        border-radius: 8px;
        background: #f9f9f9;
    }
    .scenario {
        margin: 10px 0;
        padding: 10px;
        background: #fff;
        border-left: 4px solid #007bff;
    }
    .selected-example {
        background: #e3f2fd;
        padding: 15px;
        margin: 10px;
        border: 2px solid #2196F3;
    }
    .result {
        background: #e8f5e9;
        padding: 15px;
        margin: 10px;
        border: 2px solid #4CAF50;
    }
    .error {
        color: #dc3545;
        padding: 15px;
        border: 2px solid #dc3545;
        margin: 10px;
    }
    h2 {
        color: #2c3e50;
        font-family: Arial;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
    }
    b {
        color: #2980b9;
    }
</style>';
?>