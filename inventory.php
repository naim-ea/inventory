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

    <body id="inventory-body">
        <?php
    $req = $database->prepare("SELECT * FROM items WHERE user = :user");
    $req -> bindValue(":user", $_SESSION['id']);
    $req -> execute();
    $item_list = $req->fetchAll();
    ?>
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
                <div class="inventory-content">
                    <div class="container">
                        <div class="search">
                            <?php $item_count = $req->rowCount();?>
                                <span><?=$item_count>1?$item_count." items":$item_count." item"?></span>
                                <input type="text" placeholder="Search for a product" class="search-bar">
                                <select class="select-pastry">
                                    <option value="" selected>Select a product</option>
                                    <?php foreach($item_list as $single_item): ?>
                                        <option value="<?=$single_item->pastry?>">
                                            <?=$single_item->pastry?>
                                        </option>
                                        <?php endforeach;?>
                                </select>
                                <select class="select-country">
                                    <option value="" selected>Select a country</option>
                                    <?php foreach($item_list as $single_item): ?>
                                        <option value="<?=$single_item->country?>">
                                            <?=$single_item->country?>
                                        </option>
                                        <?php endforeach;?>
                                </select>
                        </div>
                        <?php foreach($item_list as $single_item):?>
                            <form action="src/php_scripts/change.php" method="post" class="form-cart" enctype="multipart/form-data" id="<?= $single_item->id?>">
                                <input type="hidden" value="<?= $single_item->id?>" name="id">
                                <div class="pastry-img">
                                    <img src="<?='src/img/items-img/'.$single_item->photo?>">
                                    <input type='file' name='photo' class="photo" value="<?=$single_item->photo?>">
                                </div>
                                <div class="pastry-info">
                                    <div class="container">
                                        <input type="text" name="pastry" value="<?= $single_item->pastry?>" disabled class="modify-input pastry-name">

                                        <input type="text" name="country" value="<?= $single_item->country?>" disabled class="modify-input country-name">

                                        <textarea name="description" disabled class="modify-input"><?= $single_item->description?>
                                        </textarea>

                                        <input type="text" name="quantity" value="<?= $single_item->quantity?>" disabled class="modify-input quantity" size="<?= strlen($single_item->quantity)?>">

                                        <span><?=$single_item->quantity<=1?'pastry':'pastries'?></span>

                                        <br>

                                        <input type="text" name="price" value="<?= $single_item->price*$_SESSION['conversion']?>" disabled class="modify-input" size="<?= strlen($single_item->price*$_SESSION['conversion'])?>">

                                        <span><?=$_SESSION['currency']?></span>

                                        <a href="#" class="modify-button">Modify</a>

                                        <a href="#" class="delete-button">Delete</a>

                                    </div>
                                </div>
                                <div class="delete-confirmation">
                                    <div class="container">
                                        <p>Are you sure you want to delete this ?</p>
                                        <button type="submit" class="delete-conf-y">Yes</button>
                                        <a href="#" class="delete-conf-n">No</a>
                                    </div>
                                </div>
                            </form>
                            <?php endforeach;?>
                                <div class="new-item">

                                </div>
                    </div>
                </div>
            </div>
            <script src="src/js/inventory-script.js"></script>
    </body>

    </html>