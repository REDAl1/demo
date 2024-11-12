<?php
session_start();
require '../db/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_number = $_POST['product_id'];
    $description = $_POST['quantity'];
    $delivery_address = $_POST['delivery_address'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, quantity, delivery_address) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $car_number, $description, $delivery_address])) {
        echo "Заявление успешно отправлено!";
    } else {
        echo "Ошибка при отправке заявления!";
    }
}
$products = $pdo->query("SELECT id, name, price FROM products");

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
                       <button type="submit" onclick="document.location='order.php'" class="main-form-btn button">Назад</button>
                    </div>
                </div>
            </div>
            <div class="row">
            <form method="POST">
                <select name="product_id" class="main-form-btn button" required>
                    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option  value="<?php echo $row['id']; ?>">
                            <?php echo $row['name']; ?> - Цена: <?php echo $row['price']; ?> 
                        </option>
                    <?php } ?>
                </select><br>
                    <p class="text-nick">Количество: </p><input type="number" name="quantity" class="main-form-btn button" required><br>
                    <p class="text-nick">Адрес доставки: </p><input type="text" name="delivery_address" class="main-form-btn button" required><br>
                <button type="submit" class="main-form-btn button">Отправить заказ</button>
            </form>

            </div>
        </div>
    </div>
</body>
</html>
