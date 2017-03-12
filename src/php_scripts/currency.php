<?php

include_once 'db_connect.php';
session_start();


//GET VARS
$selected_currency = $_POST["select-currency"];

if(!$selected_currency==0){
    $currency_usedby = " ";
    $currency2_usedby = " ";
    
    //DELETE USER'S ID FROM CURRENT CURRENCY
    $req = $database->prepare("SELECT * FROM currency WHERE currency = :currency");
    $req->bindValue(":currency", $_SESSION['currency']);
    $req->execute();
    $currencies = $req->fetchAll();
    foreach($currencies as $_currency):
    $currency_user = explode(",", $_currency->used);
    for($i = 0; $i < count($currency_user); $i++){
        if($currency_user[$i]==$_SESSION['id']){
            unset($currency_user[$i]);
        }
    }
    $currency_usedby = implode(",", $currency_user);
    endforeach;
    
    //UPDATE CURRENT CURRENCY
    $query = $database->prepare("UPDATE currency SET used = :used WHERE currency = :currency");
    $query->bindValue(":used", $currency_usedby);
    $query->bindValue(":currency", $_SESSION['currency']);
    $query->execute();
    
    //GET NEW CURRENCY
    $query2 = $database->prepare("SELECT * FROM currency WHERE currency = :currency");
    $query2->bindValue(":currency", $selected_currency);
    $query2->execute();
    $currencies2 = $query2->fetchAll();
    foreach($currencies2 as $_currency2):
        $currency2_user = explode(",", $_currency2->used);
        array_push($currency2_user, $_SESSION['id']);
        $currency2_usedby = implode(",", $currency2_user);
        $_SESSION['conversion'] = $_currency2->conversion;
    endforeach;
    
    //UPDATE USER'S ID IN NEW CURRENCY
    $query3 = $database->prepare("UPDATE currency SET used = :used WHERE currency = :currency");
    $query3->bindValue(":used", $currency2_usedby);
    $query3->bindValue(":currency", $selected_currency);
    $query3->execute();
    
    //SESSION VAR
    $_SESSION['currency'] = $selected_currency;
}
    
header("Location: ../../settings.php");
exit();

?>