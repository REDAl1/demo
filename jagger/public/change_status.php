<?php
session_start();
require '../db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submission_id = $_POST['submission_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE submissions SET status = ? WHERE id = ?");
    if ($stmt->execute([$status, $submission_id])) {
        header("Location: admin.php");
    } else {
        echo "Ошибка при изменении статуса!";
    }
}
