


<?php


try {
    $host = 'localhost';
    $db_name='sitem';
    $charset ='utf8';
    $username = 'root';
    $password = '';
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset",$username,$password);
    
} catch (PDOException $e) {
    
    echo 'Veri tabanı bağlantı hatası: '.$e;

}
?>

