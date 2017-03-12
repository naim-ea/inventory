<?php
include_once 'src/php_scripts/db_connect.php';
include_once 'src/php_scripts/password-check.php';
session_start();

if (!isset($_SESSION['name'])) {
  header ('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Inventory</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body id="user-manage-body">
    <div class="header">
        <div class="container">
            <h1>Manage inventory</h1>
        </div>
    </div>
    <div class="side-bar">
        <ul>
            <li>
                <a href="dashboard.php">
                    <img src="src/img/other-img/dashboard.png" alt="Dashboard">
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="inventory.php"><img src="src/img/other-img/products.png" alt="Products">
                    <p>Products</p>
                </a>
            </li>
            <li>
                <a href="settings.php"><img src="src/img/other-img/settings.png" alt="Settings">
                    <p>Settings</p>
                </a>
            </li>
            <li>
                <a href="src/php_scripts/logout.php"><img src="src/img/other-img/logout.png" alt="Log out">
                    <p>Log out</p>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="action">
            <h3>Modify a user</h3>
            <form action="#" method="post">
                <input type="password" name="user-password" placeholder="Password of the concerned user">
                <div class="error-message">
                    <?= array_key_exists('wrong-password', $error_messages) ? $error_messages["wrong-password"] : '' ?>
                </div>
                <button type="submit">Confirm</button>
            </form>
        </div>
    </div>
</body>

</html>