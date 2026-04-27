<?php
header('Content-Type: text/html; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h2 style='color: red;'>Ошибка: страница доступна только после отправки формы</h2>";
    echo '<p><a href="index.php">← Вернуться к форме</a></p>';
    exit;
}
$email    = trim($_POST['email']    ?? '');
$password = trim($_POST['password'] ?? '');
$errors = [];

if (empty($email)) {
    $errors[] = "Поле «Почта» обязательно для заполнения";
}

if (empty($password)) {
    $errors[] = "Поле «Пароль» обязательно для заполнения";
}

if (!empty($errors)) {
    echo "<h2 style='color: darkred;'>Ошибка валидации формы</h2>";
    echo "<ul style='color: red;'>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<p><a href="index.php">← Вернуться и исправить</a></p>';
} else {
    echo "<h2 style='color: green;'>Форма успешно отправлена!</h2>";
    echo "<p>Email: <strong>" . htmlspecialchars($email) . "</strong></p>";
    echo '<p><a href="index.php">← На главную</a></p>';
}

?>
