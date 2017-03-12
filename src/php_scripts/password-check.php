<?php 
include_once "src/php_scripts/db_connect.php";

$error_messages = array();

if(!empty($_POST)){
    
    //GET VARS
    $user_password = sha1($_POST['user-password']);
    $user_id = $_GET['id'];
    
    $req=$database->prepare("SELECT * FROM users WHERE id = :id");
    $req->bindValue(":id", $user_id);
    $req->execute();
    
    $user_infos = $req->fetchAll();
    
    foreach($user_infos as $_userinfos):
        //CHECK IF PASSWORD ENTERED IS THE ONE OF THE USER WANTING TO MODIFY HIS DATA
        if($_userinfos->password == $user_password){
            header("Location: user_change.php?id=".$user_id);
        }
        else{
            $error_messages["wrong-password"] = "Wrong password !";
        }
    endforeach;
}
?>
