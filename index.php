<?php 
include_once 'src/php_scripts/db_connect.php';
include_once 'src/php_scripts/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Log to your professionnal space</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body id="index-body">
    <form action="#" method="post" class="form-cart">
        <div class="image">

        </div>
        <div class="inputs">
            <div class="container">
                <h2 class="login-title">Welcome to your pro space !</h2>
                <p>Login to manage your business</p>
                <p>(You should try root and root for both username and password, or admin and admin)</p>
                <input type="text" placeholder="Username" name="name">
                <div class="error-message">
                    <?= array_key_exists('name', $error_messages) ? $error_messages["name"] : '' ?>
                </div>
                <input type="password" placeholder="Password" name="password">
                <div class="error-message">
                    <?= array_key_exists('password', $error_messages) ? $error_messages["password"] : '' ?>
                </div>
                <div class="error-message">
                    <?= array_key_exists('total', $error_messages) ? $error_messages["total"] : '' ?>
                </div>
                <div class="error-message">
                    <?= array_key_exists('wrong', $error_messages) ? $error_messages["wrong"] : '' ?>
                </div>
                <button type="submit">Connect</button>
            </div>
        </div>
    </form>
</body>

</html>