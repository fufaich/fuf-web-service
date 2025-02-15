<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя страница</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            background-color: white;
            border: 2px solid black;
            width: 50%;
            margin: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            font-weight: bold;
            background-color: #cce5ff;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <script>
        document.open();

        let surname = prompt("Введите вашу фамилию:");
        let name = prompt("Введите ваше имя:");
        let patronymic = prompt("Введите ваше отчество:");
        let birthdate = prompt("Введите вашу дату рождения (ДД-ММ-ГГГГ):");
        let birthplace = prompt("Введите место рождения:");
        let height = prompt("Введите ваш рост (см):");
        let weight = prompt("Введите ваш вес (кг):");
        let avatar = prompt("Введите URL вашего аватара:");

        document.write("<div class='container'>");
        document.write("<h2>Персональные данные</h2>");
        document.write("<table>");
        document.write("<tr><th>ФИО</th><td>" + surname + " " + name + " " + patronymic + "</td></tr>");
        document.write("<tr><th>Дата рождения</th><td>" + birthdate + "</td></tr>");
        document.write("<tr><th>Место рождения</th><td>" + birthplace + "</td></tr>");
        document.write("<tr><th colspan='2'>Дополнительная информация</th></tr>");
        document.write("<tr><td>Рост</td><td>" + height + " см</td></tr>");
        document.write("<tr><td>Вес</td><td>" + weight + " кг</td></tr>");
        document.write("<tr><td>Аватар</td><td><img src='" + avatar + "' alt='Аватар'></td></tr>");
        document.write("</table>");
        document.write("</div>");

        document.close();
    </script>

</body>
</html>