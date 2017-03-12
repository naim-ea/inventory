<?php
include_once 'src/php_scripts/db_connect.php';

if(!empty($_POST)){
$id = $_GET["id"];
$change_fname = $_POST['fname'];
$change_lname = $_POST['lname'];
$change_uname = $_POST['username'];
$change_password = sha1($_POST['new-password']);

$req = $database->prepare("UPDATE users SET fname = :fname, lname = :lname, name = :name, password = :password WHERE id = :id");
$req->bindValue(':fname', $change_fname);
$req->bindValue(':lname', $change_lname);
$req->bindValue(':name', $change_uname);
$req->bindValue(':password', $change_password);
$req->bindValue(':id', $id);
$exec = $req->execute();

header("Location: settings.php");
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
            <a href="#" class="add-product">
                <div class="click-to-add">
                    <p class="add">+</p>
                </div>
            </a>
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
            <div class="container">
                <div class="action">
                   <h3>Modify a user</h3>
                    <form action="#" method="post">
                        <input type="text" name="fname" placeholder="First name">
                        <input type="text" name="lname" placeholder="Last name">
                        <input type="text" name="username" placeholder="Username">
                        <input type="password" name="new-password" placeholder="Password">
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </body>
</html>