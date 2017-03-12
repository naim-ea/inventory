<?php
include_once 'src/php_scripts/db_connect.php';

$error_messages   = array();

if(!empty($_POST)){
    //CHECK FOR ERRORS
    if(empty($_POST['name'])&&empty($_POST['password'])){
        $error_messages["total"] = "You didn't write anything !";
    }
    else if(empty($_POST['name'])){
        $error_messages["name"] = "You didn't write your username !";
    }
    else if(empty($_POST['password'])){
        $error_messages["password"] = "You didn't write your password !";
    }
    else{
        $error_messages["wrong"] = "Wrong username or password !";
    }
    
    //GET VARS
    $name = htmlspecialchars($_POST['name']);
    $pass_hache = sha1($_POST['password']);
    
    $req = $database->prepare("SELECT * FROM users WHERE name = :name AND password = :password");
    $req->bindValue(":name", $name);
    $req->bindValue(":password", $pass_hache);
    $req->execute();
    $userexist = $req->rowCount();
    if($userexist > 0)
    {
        $userinfo = $req->fetchAll();
        session_start();
        
        //GIVE SESSION VARS
        foreach($userinfo as $_userinfo):
            $_SESSION['id'] = $_userinfo->id;
            $_SESSION['name'] = $_userinfo->name;
            $_SESSION['fname'] = $_userinfo->fname;
            $_SESSION['lname'] = $_userinfo->lname;
            $_SESSION['password'] = $_userinfo->password;
            
        
            //CHECK USER'S USED CURRENCY
            $query = $database->query("SELECT * FROM currency");
            $used_currency = $query -> fetchAll();
            foreach($used_currency as $_used_currency):
                $usedby = explode(",", $_used_currency->used);
                for($i = 0; $i < count($usedby); $i++){
                    if($usedby[$i]==$_SESSION['id']){
                        $_SESSION['currency'] = $_used_currency->currency;
                        $_SESSION['conversion'] = $_used_currency->conversion;
                    }
                }
            endforeach;
        endforeach;
        header("Location: dashboard.php");
        exit();
    }
    
}
else
{
	// Default form data
	$_POST['name'] = '';
	$_POST['password'] = '';
}


?>