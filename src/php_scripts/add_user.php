<?php
include_once 'db_connect.php';

if(!empty($_POST)){
    //GET VARS
    $added_fname = $_POST['fname'];
    $added_lname = $_POST['lname'];
    $added_uname = $_POST['username'];
    $added_pass = sha1($_POST['password']);
    
    $currency2_usedby = " ";
    $user_id = " ";
    
    
    $req = $database->prepare("SELECT * FROM users WHERE uname = :uname");
    $req->bindValue(":uname", $added_uname);
    $req->execute();
    $existing_users_number = $req->rowCount();
    
    //TEST IF THE USER ALREADY EXISTS
    if($existing_users_number < 1){
        $query = $database->prepare('INSERT INTO users (fname, lname, name, password) VALUES (:fname, :lname, :uname, :password)');
        $query->bindValue(':fname', $added_fname);
        $query->bindValue(':lname', $added_lname);
        $query->bindValue(':uname', $added_uname);
        $query->bindValue(':password', $added_pass);
        $exec = $query->execute();
        
        //ADD NEW USER IN CURRENCY
        $query2 = $database->prepare("SELECT * FROM currency WHERE currency = :currency");
        $query2->bindValue(":currency", "euros");
        $query2->execute();
        $currencies2 = $query2->fetchAll();
        foreach($currencies2 as $_currency2):
            $currency2_user = explode(",", $_currency2->used);
                $query4 = $database->prepare("SELECT * FROM users WHERE name = :username");
                $query4->bindValue(":username", $added_uname);
                $query4->execute();
                $users = $query4->fetchAll();
                foreach($users as $_user):
                    $user_id = $_user->id;
                endforeach;
            array_push($currency2_user, $user_id);
            $currency2_usedby = implode(",", $currency2_user);
        endforeach;
        
        //UPDATE USER'S ID IN NEW CURRENCY
        $query3 = $database->prepare("UPDATE currency SET used = :used WHERE currency = :currency");
        $query3->bindValue(":used", $currency2_usedby);
        $query3->bindValue(":currency", "euros");
        $query3->execute();
    }
    else{
        echo 'Username already exists !';
    }
}
header("Location: ../../settings.php");
exit();
?>