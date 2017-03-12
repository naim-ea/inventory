<?php
include_once 'db_connect.php';
session_start();

if(!empty($_POST) || is_numeric($added_quantity) ||  is_numeric($added_price)){
    //GET VARS
    $id = $_POST['id'];
    $change_pastry = $_POST['pastry'];
    $change_country = $_POST['country'];
    $change_description = $_POST['description'];
    $change_quantity = $_POST['quantity'];
    $change_price = $_POST['price'];
    
    
    //CHECK IF A PHOTO HAS BEEN UPLOADED
    if($_FILES['photo']['error'] > 0){
        $req = $database->prepare("SELECT * FROM items WHERE id = :id AND user = :user");
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $_SESSION['id']);
        $req->execute();
        $fetch = $req->fetchAll();
        foreach($fetch as $_fetch):
        //IF NOT, RENAME IT WITH NEW NAME AND COUNTRY
        rename(DOCROOT."/img/items-img/".$_fetch->pastry.$_fetch->country.".jpg", DOCROOT."/img/items-img/".$change_pastry.$change_country.".jpg");
        endforeach;
        
        $req = $database->prepare("UPDATE items SET pastry = :pastry, country = :country, description = :description, quantity = :quantity, price = :price, photo = :photo WHERE id = :id AND user = :user");
        $req->bindValue(':pastry', $change_pastry);
        $req->bindValue(':country', $change_country);
        $req->bindValue(':description', $change_description);
        $req->bindValue(':quantity', $change_quantity);
        $req->bindValue(':price', $change_price);
        $req->bindValue(':photo', $change_pastry.$change_country.".jpg");
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $_SESSION['id']);
        $exec = $req->execute();
    }
    else{
        //IF YES, UPLOAD IT TO THE GOOD FOLDER AND CHANGE ITS NAME WITH PASTRY AND COUNTRY
        $_FILES['photo']['name'] = $change_pastry.$change_country.'.jpg';
        $change_photo = $_FILES['photo']['name'];
        //MOVE PHOTO TO OTHER FOLDER
        move_uploaded_file($_FILES['photo']['tmp_name'], DOCROOT.'/img/items-img/'.basename($_FILES['photo']['name']));
        
        $req = $database->prepare("UPDATE items SET pastry = :pastry, country = :country, description = :description, quantity = :quantity, price = :price, photo = :photo WHERE id = :id AND user = :user");
        $req->bindValue(':pastry', $change_pastry);
        $req->bindValue(':country', $change_country);
        $req->bindValue(':description', $change_description);
        $req->bindValue(':quantity', $change_quantity);
        $req->bindValue(':price', $change_price);
        $req->bindValue(':photo', $change_photo);
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $_SESSION['id']);
        $req->execute();
    } 
}
header("Location: ../../inventory.php");
exit();
?>