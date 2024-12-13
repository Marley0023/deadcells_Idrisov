<?php
$servername = "127.0.0.1";
$username = "root";    
$password = "";       
$dbname = "bd_dead";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

echo "Успешное подключение к базе данных!";
?>
