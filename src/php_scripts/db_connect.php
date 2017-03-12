<?php 

define('DB_HOST','localhost');
define('DB_NAME','inventory');
define('DB_USER','root');
define('DB_PASS','root'); 
define('DOCROOT', dirname(__FILE__, 2));

try
{
    $database = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch (Exception $e)
{
    die('Could not connect');
}

?>