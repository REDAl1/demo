<?php
session_start();
require '../db/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: lndex.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->query("SELECT orders.id, products.name, orders.quantity, orders.status, delivery_address FROM orders JOIN products ON orders.product_id = products.id WHERE orders.user_id = $user_id");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();


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
                        <button type="submit" onclick="document.location='../Index.php'" class="main-form-btn button">выйти</button>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-11 welcome">
                        <p class="text-nick">Привет, <?php echo $fullname ?></p>
                    </div>
                </div>
                <div class=" col-lg-5 messenge">
                    <p class="text-nick">Мои заказы</p>
                </div>
                <div class="col-lg-offset-1 col-lg-5 messenge">
                    <p class="text-nick"><a href="new_order.php" >Создать новое заказ</a></p>
                </div>
                <div class="col-lg-11 statement">
                    <ul>
                        <?php foreach ($orders as $order): ?>
                            <li>
                                <?php echo ">Товар: " . $order['name'] . ", Количество: " . $order["quantity"] . " Статус: " . $order['status'] . " Адрес: " . $order['delivery_address']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </row>
        </div>
    </div>
</body>
</html>
