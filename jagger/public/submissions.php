<?php
session_start();
require '../db/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM submissions WHERE user_id = ?");
$stmt->execute([$user_id]);
$submissions = $stmt->fetchAll();


$stmt = $pdo->prepare("SELECT full_name FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$fullname = htmlspecialchars($user['full_name']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Мои заявления</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="col-lg-2 test1">
                        <button type="submit" onclick="document.location='login.php'" class="main-form-btn button">выйти</button>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-11 welcome">
                        <p class="text-nick">Привет, <?php echo $fullname ?></p>
                    </div>
                </div>
                <div class=" col-lg-5 messenge">
                    <p class="text-nick">Мои заявления</p>
                </div>
                <div class="col-lg-offset-1 col-lg-5 messenge">
                    <p class="text-nick"><a href="new_submission.php" >Создать новое заявление</a></p>
                </div>
                <div class="col-lg-11 statement">
                    <ul>
                        <?php foreach ($submissions as $submission): ?>
                            <li>
                                <?php echo ">Номер: " . $submission['car_number'] . ", Описание: " . $submission["description"] . " Статус: " . $submission['status']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </row>
        </div>
    </div>
</body>
</html>
