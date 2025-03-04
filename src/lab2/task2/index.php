<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Извещение о посылке</title>
    <style>
        .container {
            width: 600px;
            margin: auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .section {
            border-bottom: 1px solid #000;
            padding: 10px;
        }
        .color-box {
            width: 50px;
            height: 50px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Извещение о посылке</h2>
    <form method="post">
        <div class="section">
            <label>Дата создания: <input type="date" name="date" required></label><br>
        </div>
        <div class="section">
            <h3>Персональная информация</h3>
            <label>Введите имя: <input type="text" name="name" required></label><br>
            <label>Введите E-Mail: <input type="email" name="email" required></label><br>
            <label>Комментарий:<br> <textarea name="comment" rows="4"></textarea></label>
        </div>
        <div class="section">
            <h3>Дополнительная информация</h3>
            <label>Доставка:<br>
                <input type="checkbox" name="delivery[]" value="Курьер"> Курьер
                <input type="checkbox" name="delivery[]" value="Самолет"> Самолет
                <input type="checkbox" name="delivery[]" value="Поезд"> Поезд
                <input type="checkbox" name="delivery[]" value="Автотранспорт"> Автотранспорт
            </label><br>
            <label>Форма посылки:
                <select name="shape">
                    <option value="Круглая">Круглая</option>
                    <option value="Прямоугольная">Прямоугольная</option>
                </select>
            </label><br>
            <label>Цвет посылки: <input type="color" name="color"></label><br>
            <label>Количество: <input type="number" name="quantity" min="1" required></label>
        </div>
        <div class="section">
            <h3>Дополнительные параметры</h3>
            <label>Тара:<br>
                <select name="packaging[]" multiple>
                    <option value="Бьющаяся">Бьющаяся</option>
                    <option value="Хрупкая">Хрупкая</option>
                    <option value="Водонепроницаемая">Водонепроницаемая</option>
                    <option value="Пожаростойкая">Пожаростойкая</option>
                </select>
            </label><br>
            <label>Вес:<br>
                <input type="radio" name="weight" value="до 50 кг"> до 50 кг
                <input type="radio" name="weight" value="больше 50 кг"> больше 50 кг
            </label>
        </div>
        <button type="submit" name="send">Отправить</button>
        <button type="reset">Очистка</button>
    </form>
</div>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])): ?>
    <div class="container">
        <h2>Подтверждение отправки</h2>
        <table border="1">
            <?php foreach ($_POST as $key => $value): ?>
                <?php if ($key !== 'send'): ?>
                    <tr>
                        <th><?= htmlspecialchars(ucfirst($key)) ?></th>
                        <td>
                            <?php if (is_array($value)): ?>  
                                <?= htmlspecialchars(implode(", ", $value)) ?>
                            <?php elseif ($key === 'color'): ?>
                                <div class="color-box" style="background-color: <?= htmlspecialchars($value) ?>;"></div> <?= htmlspecialchars($value) ?>
                            <?php else: ?>
                                <?= htmlspecialchars($value) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
</body>
</html>