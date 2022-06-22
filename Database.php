<?php 

try{
    $DSN = 'mysql:host=localhost;dbname=deneme';
    $ConnectingDB = new PDO($DSN,'root', '');
}
catch (PDOException $e){
    print $e->getMessage();
}


?>