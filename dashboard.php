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

    <body id="dashboard-body">
        <?php
        $req = $database->prepare("SELECT * FROM items WHERE user = :user");
        $req -> bindValue(":user", $_SESSION['id']);
        $req -> execute();
        $item_list = $req->fetchAll();
        ?>
            <div class="header">
                <div class="container">
                    <h1>Dashboard</h1>
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
                <div class="welcome-message">
                    <div class="container">
                        <h2>Welcome back, <?=$_SESSION['fname'].' '.$_SESSION['lname']?> !</h2>
                    </div>
                </div>
                <div class="dashboard-content">
                    <div class="container">
                        <div class="dashboard-divs">
                            <div class="different-pastries">
                                <?php $item_count = $req->rowCount();?>
                                    <h2><?= $item_count?></h2>
                                    <p>different pastries</p>
                            </div>
                            <div class="average-quantity">
                                <?php $total_quantity = 0;
                                foreach($item_list as $single_item):
                                    $total_quantity = $total_quantity + $single_item->quantity;
                                endforeach;
                                if($item_count == 0){
                                    $average_quantity = 0;
                                }
                                else{
                                    $average_quantity = $total_quantity / $item_count;}
                                ?>
                                    <h2><?=round($average_quantity)?></h2>
                                    <p>average quantity per pastry</p>
                            </div>
                            <div class="total-pastries">
                                <h2><?= $total_quantity?></h2>
                                <p>total pastries</p>
                            </div>
                            <div class="low-quantities">
                                <h2>What products should I care about ?</h2>
                                <a href="inventory.php">View all products</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Pastry</th>
                                            <th>Country</th>
                                            <th>Quantity left</th>
                                            <th>Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = $database->prepare("SELECT * FROM items WHERE user = :user ORDER BY quantity ASC");
                                            $query -> bindValue(":user", $_SESSION['id']);
                                            $query -> execute();
                                            $sorted_items = $query->fetchAll();
                                            
                                            $i = 1;
                                            foreach($sorted_items as $_sorted_item):
                                
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $_sorted_item->pastry?>
                                                </td>
                                                <td>
                                                    <?= $_sorted_item->country?>
                                                </td>
                                                <td>
                                                    <?= $_sorted_item->quantity?>
                                                </td>
                                                <td>
                                                    <a href="<?= 'inventory.php#'.$_sorted_item->id?>">Check</a>
                                                </td>
                                            </tr>
                                            <?php 
                                            if ($i++ == 5) break;
                                            endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pastries-map">
                                <h2>Where do your pastries come from ?</h2>
                                <div class="countries">
                                    <?php $query = $database->prepare("SELECT * FROM items WHERE user = :user");
                                    $query->bindValue(":user", $_SESSION["id"]);
                                    $query->execute();
                                    $country_list=$query->fetchAll();
                                    foreach($country_list as $_country):?>
                                        <span class="country"><?=$_country->country?>, </span>
                                        <?php endforeach; ?>
                                </div>
                                <div id="map" style="width:90%;height:400px;margin: 40px auto;"></div>
                                <script>
                                    var country = document.querySelectorAll("span.country");
                                    var country_list = [];
                                    for (var j = 0; j < country.length; j++) {
                                        country_list.push(country[j].innerHTML);
                                    }
                                    console.log(country_list);

                                    function initMap() {
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 2,
                                            center: {
                                                lat: 20,
                                                lng: 0
                                            },
                                            minZoom:2,
                                            maxZoom:2,
                                        });
                                        var geocoder = new google.maps.Geocoder();
                                        geocodeAddress(geocoder, map);
                                    }

                                    function geocodeAddress(geocoder, resultsMap) {
                                        for (var i = 0; i < country_list.length; i++) {
                                            geocoder.geocode({
                                                'address': country_list[i]
                                            }, function (results, status) {
                                                if (status === google.maps.GeocoderStatus.OK) {
                                                    var marker = new google.maps.Marker({
                                                        map: resultsMap,
                                                        position: results[0].geometry.location
                                                    });
                                                } else {
                                                    alert('Geocode was not successful for the following reason: ' + status);
                                                }
                                            });
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSyzB0TqKo419qD8gCwOYSsLzV2pIZC4c&callback=initMap" async defer></script>
    </body>

    </html>