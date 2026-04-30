<?php
// includes/migrate.php — простая и надёжная версия

require_once __DIR__ . '/db.php';

if (!isset($conn) || $conn === false) {
    die("❌ Ошибка: Нет подключения к базе данных.\n");
}

$migrationsDir = __DIR__ . '/../migrations';
$files = array_diff(scandir($migrationsDir), ['.', '..']);
sort($files);

echo "🚀 Применение миграций...\n";

foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) !== 'sql') continue;
    
    $name = pathinfo($file, PATHINFO_FILENAME);
    $sql = file_get_contents("$migrationsDir/$file");
    
    if (pg_query($conn, $sql)) {
        echo "✅ Успешно применена: $file\n";
    } else {
        echo "❌ Ошибка при применении $file: " . pg_last_error($conn) . "\n";
        exit(1);
    }
}

echo "🎉 Все миграции успешно применены!\n";
?>
