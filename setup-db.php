<?php
echo "🚀 Инициализация базы данных...\n";

require_once 'includes/migrate.php';

// Добавляем тестовые данные, если таблица пустая
require_once 'includes/db.php';

$check = pg_query($conn, "SELECT COUNT(*) as cnt FROM articles");
$row = pg_fetch_assoc($check);

if ((int)$row['cnt'] === 0) {
    pg_query_params($conn,
        "INSERT INTO articles (title, content, author_name, rating) 
         VALUES ($1, $2, $3, $4)",
        ['Первая тестовая статья', 'Это тестовая статья, созданная при инициализации базы данных.', 'Администратор', 5]
    );
    echo "🧪 Добавлены тестовые данные\n";
}

echo "✅ База данных успешно настроена!\n";
?>
