<?php

    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $password = md5($password);

        $sql = mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$password')");
        if($connect->query($sql)){
        echo "Данные успешно добавлены";
        } else{
            echo "Помилка: " . $connect->error;
        }

        $_SESSION['message'] = 'Реєстрація пройшла успішно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Паролі не співпадають';
        header('Location: ../register.php');
    }

?>
