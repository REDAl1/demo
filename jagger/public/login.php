<?php
session_start();
require '../db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role']; 

        if ($_SESSION['user_role'] === 'admin') {
            header("Location: admin.php"); // Перенаправление на админ-панель
        } else {
            header("Location: submissions.php"); // Перенаправление на страницу submissions
        }
        exit();
        
    } else {    
        echo "Неправильный логин или пароль!";
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
                    <h2 class="main-form-header">Войти в <strong>Нарушениям.Нет</strong></h2>
                    <form method="POST" action="">
                        <input class="main-form-input" type="text" name="username" placeholder="Логин" required>
                        <input class="main-form-input" type="password" name="password" placeholder="Пароль" required>
                        <button class="main-form-btn button" type="submit">Войти</button>
                        <a href="register.php" class="reg">Зарегистрироваться</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>