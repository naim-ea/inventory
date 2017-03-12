<?php 
include_once "db_connect.php";

$error_messages = array();

session_start();
if (!isset($_SESSION['name'])) {
  header ('Location: index.php');
  exit();
}

if(!empty($_POST)){
    $id = $_GET["id"];
    $user_password = sha1($_POST['user-password']);
    
    $req=$database->query("SELECT * FROM users");
    
    $user_infos = $req->fetchAll();
    
    $first = true;
    foreach($user_infos as $_userinfos):
        //CHECK IF THE PASSWORD IS THE ADMINS PASSWORD
        if($first){
            if($_userinfos->password == $user_password){
                $req = $database->prepare("DELETE FROM items WHERE user = :id");
                $req->bindValue(':id', $id);
                $exec = $req->execute();
                
                $req = $database->prepare("DELETE FROM users WHERE id = :id");
                $req->bindValue(':id', $id);
                $exec = $req->execute();
                
                header("Location: settings.php");
            }
            else{
                $error_messages["wrong-password"] = "Wrong password !";
            }
            
            $first = false;
        } 
    endforeach;
}   ?>
    
