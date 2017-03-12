<?php
include_once 'src/php_scripts/db_connect.php';
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

<body>
    <?php
    $req = $database->query("SELECT * FROM users");
    $user_list = $req->fetchAll();
    
    $req = $database->query("SELECT * FROM currency");
    $currency_list = $req->fetchAll();
    ?>
        <div class="header">
            <div class="container">
                <h1>Settings</h1>
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
            <div class="settings-content">
                <div class="container">
                    <div class="manage-users">
                        <h3>Manage users</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>User</th>
                                    <th>Modify</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($user_list as $single_user):?>
                                    <tr>
                                        <td>
                                            <?= $single_user->fname?>
                                        </td>
                                        <td>
                                            <?= $single_user->lname?>
                                        </td>
                                        <td>
                                            <?= $single_user->name?>
                                        </td>
                                        <td>
                                            <a href="modify-user.php<?= '?id='.$single_user->id?>">Modify</a>
                                        </td>
                                        <td>
                                            <a href="delete-user.php<?='?id='.$single_user->id?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>

                            </tbody>
                        </table>
                        <a href="#" class="add-user">Add new user</a>
                    </div>
                    <div class="manage-currency">
                        <h3>Manage currency</h3>
                        <form action="src/php_scripts/currency.php" method="post">
                            <p>What currency do you want to use ?</p>
                            <select name="select-currency">
                                <option value="0">Select a currency</option>
                                <?php
                                foreach($currency_list as $single_currency):?>


                                    <option value="<?=$single_currency->currency?>" </option>
                                        <?=$single_currency->currency?>
                                    </option>

                                <?php endforeach;?>
                            </select>
                            <button type="submit">Change</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="src/js/settings-script.js"></script>
</body>

</html>