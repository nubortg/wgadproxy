<!DOCTYPE html>
<html>
<head>
    <title>Редактор sites.list</title>
    <!-- Подключение стилей Tailwind UI -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <!-- Подключение стилей для темной темы -->
    <link href="dark-theme.css" rel="stylesheet" id="dark-theme-style">
</head>
<body class="bg-white dark:bg-gray-800">
    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-semibold mb-5">Редактор sites.list</h1>
        <textarea id="sitesList" class="w-full h-64 p-2 border rounded" placeholder="Введите список сайтов"><?php echo getSitesList(); ?></textarea>
        <button id="saveButton" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить</button>
        <div id="message" class="mt-3"></div>
    </div>
    <!-- Ссылка смены темы в правом верхнем углу( не сегодня :))
    <div class="fixed top-4 right-4">
        <a href="#" id="toggleThemeLink" class="text-blue-500 hover:underline">Сменить тему</a>
    </div> -->
    <!-- Подключение скриптов для работы с AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Устанавливаем начальную тему при загрузке страницы
            setInitialTheme();

            // Обработчик ссылки для переключения темы
            $('#toggleThemeLink').click(function (e) {
                e.preventDefault();
                toggleTheme();
            });

            // Обработчик кнопки "Сохранить"
            $('#saveButton').click(function () {
                const sitesList = $('#sitesList').val();

                // Отправка AJAX-запроса на сервер
                $.ajax({
                    url: 'ajax_handler.php',
                    method: 'POST',
                    data: { sitesList: sitesList },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // Обработка успешного ответа от сервера
                            $('#message').text(response.message).removeClass('text-red-500').addClass('text-green-500');
                        } else {
                            // Обработка ошибки от сервера
                            $('#message').text('Произошла ошибка при сохранении списка сайтов.').removeClass('text-green-500').addClass('text-red-500');
                        }
                    },
                    error: function () {
                        // Обработка ошибки при выполнении AJAX-запроса
                        $('#message').text('Произошла ошибка при отправке запроса на сервер.').removeClass('text-green-500').addClass('text-red-500');
                    }
                });
            });

            // Функция для установки начальной темы на основе класса body
            function setInitialTheme() {
                const darkThemeEnabled = $('body').hasClass('dark');
                updateThemeLinkText(darkThemeEnabled);
            }

            // Функция для переключения темы
            function toggleTheme() {
                const darkThemeEnabled = $('body').hasClass('dark');

                // Изменение стиля для переключения темы
                if (darkThemeEnabled) {
                    $('body').removeClass('dark');
                    $('#dark-theme-style').remove();
                } else {
                    $('body').addClass('dark');
                    $('<link/>', {
                        id: 'dark-theme-style',
                        rel: 'stylesheet',
                        href: 'dark-theme.css'
                    }).appendTo('head');
                }

                updateThemeLinkText(!darkThemeEnabled);
            }

            // Функция для обновления текста ссылки смены темы
            function updateThemeLinkText(darkThemeEnabled) {
                const themeLink = $('#toggleThemeLink');
                themeLink.text(darkThemeEnabled ? 'Светлая тема' : 'Темная тема');
            }
        });
    </script>
</body>
</html>

<?php
function getSitesList()
{
    // Файл sites.list
    $filename = 'sites.list';

    // Если файл не существует, создаем его
    if (!file_exists($filename)) {
        file_put_contents($filename, '');
    }

    // Чтение содержимого файла
    return file_get_contents($filename);
}
?>
