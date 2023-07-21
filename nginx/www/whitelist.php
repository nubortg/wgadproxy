<?php
// Указываем путь к файлу "whitelist.conf"
$whitelistFile = 'whitelist.conf';

// Читаем содержимое файла "whitelist.conf" в массив
$whitelistDomains = file($whitelistFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Устанавливаем заголовок Content-Type как application/x-ns-proxy-autoconfig
header('Content-Type: application/x-ns-proxy-autoconfig');

// Выводим текст PAC файла
echo "function FindProxyForURL(url, host) {\n";
echo "\tif (";

// Формируем условия для перенаправления через прокси
for ($i = 0; $i < count($whitelistDomains); $i++) {
    $domain = trim($whitelistDomains[$i]);
    if ($i > 0) {
        echo " || ";
    }
    // Если домен начинается с '.', значит, это поддомен домена
    if (strpos($domain, '.') === 0) {
        $domain = substr($domain, 1);
        echo "shExpMatch(host, '*.$domain')";
    } else {
        echo "shExpMatch(host, '$domain')";
    }
}

echo ") {\n";
echo "\t\treturn \"PROXY 10.2.0.50:3128;\";\n";
echo "\t} else {\n";
echo "\t\treturn \"DIRECT\";\n";
echo "\t}\n";
echo "}\n";
?>
