<?php
session_start();
require '../db/database.php';

$stmt = $pdo->query("SELECT submissions.*, users.full_name FROM submissions JOIN users ON submissions.user_id = users.id");
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
                       <button type="submit" onclick="document.location='login.php'" class="main-form-btn button">выйти</button>
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
                            <th>Номер автомобиля</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?php echo $submission['full_name']; ?></td>
                                <td><?php echo $submission['car_number']; ?></td>
                                <td><?php echo $submission['description']; ?></td>
                                <td><?php echo $submission['status']; ?></td>
                                <td>
                                    <form method="POST" action="change_status.php">
                                        <input type="hidden" name="submission_id" value="<?php echo $submission['id']; ?>">
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
