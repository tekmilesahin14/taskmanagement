<?php
$host="localhost";
$dbname="taskmanagement";
$username="root";
$password="";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>

