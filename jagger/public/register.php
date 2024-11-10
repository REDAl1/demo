<?php
require '../db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (full_name, phone, email, username, password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$full_name, $phone, $email, $username, $password])) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-5 col-xs-offset-3 col-xs-6 photo">
                <div class="main-form">
                    <h2 class="main-form-header">Зарегистрироваться на <strong>Нарушениям.Нет</strong></h2>
                    <form method="POST" action="">
                        <input class="main-form-input" type="text" name="full_name" placeholder="ФИО" required>
                        <input class="main-form-input" type="text" name="phone" placeholder="Телефон" required>
                        <input class="main-form-input" type="email" name="email" placeholder="Email" required>
                        <input class="main-form-input" type="text" name="username" placeholder="Логин" required>
                        <input class="main-form-input" type="password" name="password" placeholder="Пароль" required>
                        <button class="main-form-btn button" type="submit">Зарегистрироваться</button>
                        <a href="login.php">Есть аккаунт?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>