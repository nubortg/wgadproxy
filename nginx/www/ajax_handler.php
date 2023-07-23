<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из AJAX-запроса
    $sitesList = $_POST['sitesList'];

    // Файл sites.list
    $filename = 'sites.list';

    // Запись данных в файл
    if (file_put_contents($filename, $sitesList) !== false) {
        // Успешная запись
        $response = ['success' => true, 'message' => 'Список сайтов успешно сохранен'];
    } else {
        // Ошибка записи
        $response = ['success' => false, 'message' => 'Ошибка при сохранении списка сайтов'];
    }

    // Возвращаем ответ в формате JSON
    echo json_encode($response);
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
    echo '405 Method Not Allowed';
}
?>
