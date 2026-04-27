<?php 
include '../includes/header.php'; 

$message = '';
$name = $email = $message_text = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $message_text = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message_text)) {
        $message = '<p style="color:red;">Все поля обязательны для заполнения!</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p style="color:red;">Введите корректный email!</p>';
    } else {
        $message = '<p style="color:green;">Спасибо! Ваше сообщение получено.</p>';
        $name = $email = $message_text = '';
    }
}
?>

<main>
    <h1>Контакты</h1>
    
    <?= $message ?>
    
    <form method="post">
        <p><input type="text" name="name" placeholder="Ваше имя" value="<?= htmlspecialchars($name) ?>" required></p>
        <p><input type="email" name="email" placeholder="Ваш email" value="<?= htmlspecialchars($email) ?>" required></p>
        <p><textarea name="message" rows="6" placeholder="Ваше сообщение" required><?= htmlspecialchars($message_text) ?></textarea></p>
        <button type="submit">Отправить сообщение</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
