<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div style="max-width: 420px; margin: 40px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">

    <h2 style="text-align: center; margin-bottom: 30px;">Регистрация</h2>

    <form action="action.php" method="post">

        <label>Имя:</label>
        <input type="text" name="name" placeholder="Введите имя" required>

        <label>Почта:</label>
        <input type="email" name="email" placeholder="name@example.ru" required>

        <label>Пароль:</label>
        <input type="password" name="password" placeholder="Введите пароль" required>

        <label>Подтвердите пароль:</label>
        <input type="password" name="password_confirm" placeholder="Повторите пароль" required>

        <label>Пол:</label>
        <select name="gender" required>
            <option value="" disabled selected>Выберите пол</option>
            <option value="male">Мужской</option>
            <option value="female">Женский</option>
            <option value="other">Другой</option>
        </select>

        <label style="margin: 20px 0; display: flex; align-items: center; gap: 10px; font-size: 0.95em;">
            <input type="checkbox" name="agree" required>
            Создавая учётную запись, вы соглашаетесь с нашим<br>Условиями и конфиденциальностью
        </label>

        <input type="submit" value="Зарегистрироваться" style="background: #495057; color: white; padding: 14px; border: none; border-radius: 6px; width: 100%; font-size: 1.1em; cursor: pointer;">
    </form>

</div>
<hr style="margin: 60px 0; border: 1px solid #ddd;">

<h2 style="text-align: center; color: #333;">Калькулятор</h2>

<form action="index.php" method="post" style="max-width: 500px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.1);">
    <div style="display: flex; gap: 10px; margin-bottom: 20px; justify-content: center; flex-wrap: wrap;">
        <input type="number" name="num1" step="any" placeholder="Первое число" required style="flex: 1; min-width: 140px; padding: 12px; font-size: 1.1em;">
        
        <select name="operation" style="padding: 12px; font-size: 1.1em; min-width: 60px; text-align: center;">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">×</option>
            <option value="/">÷</option>
        </select>
        
        <input type="number" name="num2" step="any" placeholder="Второе число" required style="flex: 1; min-width: 140px; padding: 12px; font-size: 1.1em;">
    </div>

    <button type="submit" name="calculate" value="1" style="width: 100%; padding: 14px; font-size: 1.2em; background: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer;">
        Вычислить
    </button>
</form>

<?php
if (isset($_POST['calculate'])) {
    $num1 = (float) ($_POST['num1'] ?? 0);
    $num2 = (float) ($_POST['num2'] ?? 0);
    $op   = $_POST['operation'] ?? '+';

    $result = null;
    $message = '';

    switch ($op) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 == 0) {
                $message = "Ошибка: деление на ноль невозможно!";
            } else {
                $result = $num1 / $num2;
            }
            break;
    }

    echo '<div style="margin-top: 30px; text-align: center; font-size: 1.4em;">';
    if ($message) {
        echo '<span style="color: #dc3545; font-weight: bold;">' . $message . '</span>';
    } elseif ($result !== null) {
        echo 'Результат: <strong>' . number_format($result, 4, '.', ' ') . '</strong>';
    }
    echo '</div>';
}
?>
</body>
</html>

