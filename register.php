<?php
// Подключение к базе данных
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $role = $_POST['role'];

    // Проверка совпадения паролей
    if ($password !== $confirmPassword) {
        echo "Пароли не совпадают!";
        exit;
    }

    // Проверка пароля (минимум 8 символов и 1 специальный символ)
    if (strlen($password) < 8 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        echo "Пароль должен быть не менее 8 символов и содержать хотя бы один специальный символ!";
        exit;
    }

    // Хэширование пароля
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // SQL-запрос для добавления нового пользователя
    $sql = "INSERT INTO users (`Имя пользователя`, `Почта`, `Пароль`, `role`) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Привязка параметров
        $stmt->bind_param("ssss", $username, $email, $passwordHash, $role);

        if ($stmt->execute()) {
            echo "Регистрация успешна!";
        } else {
            echo "Ошибка при регистрации!";
        }

        $stmt->close();
    } else {
        echo "Ошибка при подготовке запроса!";
    }

    $conn->close();
}
?>



