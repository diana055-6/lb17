<?php 
require_once '../includes/db.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title      = trim($_POST['title'] ?? '');
    $content    = trim($_POST['content'] ?? '');
    $author     = trim($_POST['author_name'] ?? 'Администратор');
    $rating     = max(1, min(5, (int)($_POST['rating'] ?? 5)));

    if (empty($title) || empty($content)) {
        $msg = '<div class="alert error">❌ Заголовок и содержание обязательны!</div>';
    } else {
        $res = pg_query_params($conn, 
            "INSERT INTO articles (title, content, author_name, rating) 
             VALUES ($1, $2, $3, $4) RETURNING id",
            [$title, $content, $author, $rating]
        );

        if ($res) {
            header("Location: /articles.php");
            exit;
        } else {
            $msg = '<div class="alert error">❌ Ошибка при добавлении статьи: ' . pg_last_error($conn) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить статью</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="container">
        <h1>➕ Добавить новую статью</h1>
        
        <?= $msg ?>

        <form method="post" class="form">
            <label>Заголовок *</label>
            <input type="text" name="title" required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">

            <label>Автор</label>
            <input type="text" name="author_name" value="<?= htmlspecialchars($_POST['author_name'] ?? 'Администратор') ?>">

            <label>Рейтинг (1-5)</label>
            <select name="rating">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= (($_POST['rating'] ?? 5) == $i) ? 'selected' : '' ?>><?= $i ?> ★</option>
                <?php endfor; ?>
            </select>

            <label>Содержание *</label>
            <textarea name="content" rows="10" required><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>

            <button type="submit">Опубликовать статью</button>
            <a href="/articles.php" class="btn-secondary">Отмена</a>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
