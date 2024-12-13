<?php
// Подключение к базе данных
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL-запрос для получения данных пользователя
    $sql = "SELECT `Имя пользователя`, `Пароль`, `role` FROM users WHERE `Имя пользователя` = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Проверка пароля
            if (password_verify($password, $user['Пароль'])) {
                echo "Добро пожаловать, " . $user['Имя пользователя'] . "!";
                echo "<br>Ваша роль: " . ($user['role'] == 'editor' ? 'Редактор' : 'Просмотр');
            } else {
                echo "Неверный пароль!";
            }
        } else {
            echo "Пользователь не найден!";
        }

        $stmt->close();
    } else {
        echo "Ошибка при подготовке запроса!";
    }

    $conn->close();
}
?>
