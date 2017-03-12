<?php
include_once 'db_connect.php';
session_start();

if(!empty($_POST) || is_numeric($added_quantity) ||  is_numeric($added_price)){
    //GET VARS
    $added_pastry = $_POST['pastry'];
    $added_country = $_POST['country'];
    $added_description = $_POST['description'];
    $added_quantity = $_POST['quantity'];
    $added_price = $_POST['price'];
    
    //TEST IF PHOTO IS A PHOTO
    $valid_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
    if ( !in_array($extension_upload,$valid_extensions) ) {
        die("Incorrect file extension");
    }
    
    //TEST PHOTO'S SIZE
    $maxwidth = 2000;
    $maxheight = 2000;
    $image_sizes = getimagesize($_FILES['photo']['tmp_name']);
    if ($image_sizes[0] > $maxwidth || $image_sizes[1] > $maxheight){ 
        die("Image is too big !");
    }
    
    
    //CHANGE PHOTOS NAME
    $_FILES['photo']['name'] = $added_pastry.$added_country.'.jpg';
    $added_photo = $_FILES['photo']['name'];
    


    //MOVE PHOTO TO OTHER FOLDER
    move_uploaded_file($_FILES['photo']['tmp_name'], DOCROOT.'/src/img/items-img/'.basename($_FILES['photo']['name']));
    
    
    
    $req = $database->prepare("SELECT * FROM items WHERE pastry = :pastry AND country = :country AND price = :price");
    $req->bindValue(":pastry", $added_pastry);
    $req->bindValue(":country", $added_country);
    $req->bindValue(":price", $added_price);
    $req->execute();
    $existing_pastries_number = $req->rowCount();
    
    //TEST IF THE PRODUCT ALREADY EXISTS TO CHANGE IT OR NOT
    if($existing_pastries_number < 1){
        $query = $database->prepare('INSERT INTO items (pastry, country, description, quantity, price, photo, user) VALUES (:pastry, :country, :description, :quantity, :price, :photo, :user)');
        $query->bindValue(':pastry', $added_pastry);
        $query->bindValue(':country', $added_country);
        $query->bindValue(':description', $added_description);
        $query->bindValue(':quantity', $added_quantity);
        $query->bindValue(':price', $added_price);
        $query->bindValue(':photo', $added_photo);
        $query->bindValue(':user', $_SESSION['id']);
        $exec = $query->execute();
    }
    else{
        $existing_pastries = $req->fetchAll();
        foreach($existing_pastries as $single_existing_pastry){
            $new_quantity = $single_existing_pastry[4] + $added_quantity;
        }
        $query = $database->prepare("UPDATE items SET quantity = :quantity, price = :price, description = :description WHERE pastry = :pastry AND country = :country AND user = :user ");
        $query->bindValue(':pastry', $added_pastry);
        $query->bindValue(':country', $added_country);
        $query->bindValue(':description', $added_description);
        $query->bindValue(':quantity', $new_quantity);
        $query->bindValue(':price', $added_price);
        $query->bindValue(':user', $_SESSION['id']);
        $exec = $query-> execute();
    }
}
header("Location: ../../inventory.php");
exit();
?>