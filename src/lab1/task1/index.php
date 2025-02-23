<!DOCTYPE html>
<html>
<head>
    <title>Персональные данные</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Geist Mono';
            margin: 0;
            padding: 40px;
            background-color:rgb(143, 173, 219);
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
        table { 
            border-collapse: collapse; 
            margin: 20px auto;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { 
            border: 1px solid #e1e4e8;
            padding: 12px; 
            text-align: center; 
        }
        th { 
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: bold;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
</head>
<?php
    $fam = "<script>document.write(prompt('Фамилия'));</script>";
    $name = "<script>document.write(prompt('Имя'));</script>";
    $otch = "<script>document.write(prompt('Отчество'));</script>";
    $date = "<script>document.write(prompt('Дата рождения'));</script>";
    $city = "<script>document.write(prompt('Город'));</script>";
    $rost = "<script>document.write(prompt('Рост'));</script>";
    $ves = "<script>document.write(prompt('Вес'));</script>";
?>
<body>
    <div class="container">
        <table>
            <tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Дата рождения</th>
                <th>Город рождения</th>
            </tr>
            <tr>
                <td><?php echo $fam ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $otch ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $city ?></td>
            </tr>
            <tr><th colspan="5">Дополнительная информация</th></tr>
            <tr>
                <td rowspan="2">
                    <img src="avatar.jpg" alt="Аватар"/>
                </td>
                <th colspan="2">Рост</th>
                <td colspan="2"><?php echo $rost ?></td>
            </tr>
            <tr>
                <th colspan="2">Вес</th>
                <td colspan="2"><?php echo $ves ?></td>
            </tr>
        </table>
    </div>
</body>
</html>