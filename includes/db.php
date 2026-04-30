<?php
// includes/db.php — исправленная версия подключения

// Загружаем .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}

// Параметры подключения
$host     = getenv('PGHOST')     ?: '127.0.0.1';
$port     = getenv('PGPORT')     ?: '5432';
$dbname   = getenv('PGDATABASE') ?: 'rodionova_db';
$user     = getenv('PGUSER')     ?: 'postgres';
$pass     = getenv('PGPASSWORD') ?: '1';

$connectionString = "host=$host port=$port dbname=$dbname user=$user password=$pass";

$conn = pg_connect($connectionString);

if (!$conn) {
    die("❌ Ошибка подключения к PostgreSQL: " . pg_last_error() . "\nConnection string: " . $connectionString);
}

echo "✅ Подключение к PostgreSQL успешно установлено.\n";
?>
