<?php
session_start();
require '../db/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO submissions (user_id, car_number, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$user_id, $car_number, $description])) {
        echo "Заявление успешно отправлено!";
    } else {
        echo "Ошибка при отправке заявления!";
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
            <div class="header">
                <div class="row">
                    <div class="col-lg-2 test1">
                       <button type="submit" onclick="document.location='submissions.php'" class="main-form-btn button">выйти</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="POST" action="">
                    <input type="text" name="car_number" placeholder="Номер автомобиля" class="main-form-btn button" required>
                    <textarea name="description" placeholder="Описание нарушения" class="main-form-btn button" required></textarea>
                    <button type="submit" class="main-form-btn button">Отправить заявление</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
