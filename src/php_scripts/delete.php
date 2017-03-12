<?php 
include_once 'db_connect.php';
session_start();

//GET VARS
$id = $_POST['id'];
$delete_pastry = $_POST['pastry'];
$delete_country = $_POST['country'];
$delete_img = DOCROOT."/src/img/items-img/".$delete_pastry.$delete_country.'.jpg';

//CHECK IF IMAGE EXISTS AND DELETE IT
if(file_exists ($delete_img)){
    unlink($delete_img);
}

$req = $database->prepare("DELETE FROM items WHERE id = :id AND user = :user");
$req->bindValue(':id', $id);
$req->bindValue(':user', $_SESSION['id']);
$exec = $req->execute();

header("Location: ../../inventory.php");
exit();
?>