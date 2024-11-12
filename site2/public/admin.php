<?php
session_start();
require '../db/database.php';

$stmt = $pdo->query("SELECT orders.id, users.full_name, users.email, delivery_address, products.name AS product_name, orders.quantity, orders.status FROM orders JOIN users ON orders.user_id = users.id JOIN products ON orders.product_id = products.id");
$submissions = $stmt->fetchAll();



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
                       <button type="submit" onclick="document.location='../index.php'" class="main-form-btn button">выйти</button>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-11 welcome">
                        <p class="text-nick">Привет, Администратор</p>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-11 statementadm">
                    <table class="table">
                        <tr>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th>Товар</th>
                            <th>Количество</th>
                            <th>Адрес</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?php echo $submission['full_name']; ?></td>
                                <td><?php echo $submission['email']; ?></td>
                                <td><?php echo $submission['product_name']; ?></td>
                                <td><?php echo $submission['quantity']; ?></td>
                                <td><?php echo $submission['delivery_address']; ?></td>
                                <td><?php echo $submission['status']; ?></td>
                                <td>
                                    <form method="POST" action="change_status.php">
                                        <input type="hidden" name="product_id" value="<?php echo $submission['id']; ?>">
                                        <select name="status">
                                            <option value="Подтверждено">Подтвердить</option>
                                            <option value="Отказано">Отклонить</option>
                                        </select>
                                        <button type="submit">Изменить статус</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
