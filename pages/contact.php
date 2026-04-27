<?php 
include '../includes/header.php'; 

$message = '';
$name = $email = $message_text = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $message_text = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message_text)) {
        $message = '<p class="error">Все поля обязательны для заполнения!</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p class="error">Введите корректный email адрес!</p>';
    } else {
        $message = '<p class="success">Спасибо! Ваше сообщение успешно отправлено.</p>';
        $name = $email = $message_text = '';
    }
}
?>

<main>
    <div class="container">
        <h1>Связаться с нами</h1>
        
        <?= $message ?>

        <form method="post" class="contact-form">
            <div class="form-group">
                <label for="name">Ваше имя</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email адрес</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" rows="6" required><?= htmlspecialchars($message_text) ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Отправить сообщение</button>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
