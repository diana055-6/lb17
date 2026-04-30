<?php require_once 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статьи - rodionova.com</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="container">
        <div class="page-header">
            <h1>📚 Все статьи</h1>
            <a href="/pages/add_article.php" class="btn-primary">➕ Добавить статью</a>
        </div>

        <?php
        $result = pg_query($conn, "SELECT * FROM articles ORDER BY created_at DESC");
        
        if (pg_num_rows($result) > 0):
            while ($article = pg_fetch_assoc($result)):
        ?>
            <article class="card">
                <h2><?= htmlspecialchars($article['title']) ?></h2>
                <div class="meta">
                    <span>✍️ <?= htmlspecialchars($article['author_name']) ?></span>
                    <span>⭐ <?= $article['rating'] ?>/5</span>
                    <span>📅 <?= date('d.m.Y H:i', strtotime($article['created_at'])) ?></span>
                </div>
                <p><?= nl2br(htmlspecialchars(mb_strimwidth($article['content'], 0, 250, '...'))) ?></p>
                <a href="#" class="read-more">Читать полностью →</a>
            </article>
        <?php
            endwhile;
        else:
        ?>
            <p>Пока нет статей. Будьте первым!</p>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
