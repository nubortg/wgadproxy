<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Приветствие</title>
</head>
<body>
    <?php
    // Получаем текущее время
    $currentTime = date("H:i:s");

    // Задаем приветственное сообщение в зависимости от времени суток
    $greeting = "";
    if ($currentTime >= "06:00:00" && $currentTime < "12:00:00") {
        $greeting = "Доброе утро";
    } elseif ($currentTime >= "12:00:00" && $currentTime < "18:00:00") {
        $greeting = "Добрый день";
    } elseif ($currentTime >= "18:00:00" && $currentTime < "23:59:59") {
        $greeting = "Добрый вечер";
    } else {
        $greeting = "Доброй ночи";
    }
    ?>

    <h1><?php echo $greeting; ?>!</h1>
    <p>Сейчас: <?php echo $currentTime; ?></p>
    <p>Добро пожаловать на нашу страницу.</p>
</body>
</html>
