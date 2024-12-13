<?php
include 'bd.php'; // Подключение к базе данных

// Получаем список оружия
$sql = "SELECT * FROM weapons";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['Название'] . "</td>";
    echo "<td>" . $row['Описание'] . "</td>";
    echo "<td>" . $row['Урон'] . "</td>";
    echo "</tr>";
}

$conn->close();
?>
