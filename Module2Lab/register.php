<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація и регістрація</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Форма регистрации -->
<div class="wrapper">
  <div class="header">
    <h3 class="sign-in">Регістрація</h3>
    <div class="button">
        <a class="sign-in" href="/index.php">Увійти</a>
    </div>
  </div>
  <div class="clear"></div>
    <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
       <div>
        <label class="sign-in">ПІБ</label>
            <input class="user-input" type="text" name="full_name" placeholder="Введіть своє повне ім'я">
        </div>
        <div>
            <label class="sign-in">Логін</label>
            <input class="user-input" type="text" name="login" placeholder="Введіть свій логін">  
        </div>
       <div>
            <label class="sign-in">Пошта</label>
            <input class="user-input" type="text" name="email" placeholder="Введіть електронну пошту">
       </div>
        <div>
            <label class="sign-in">Пароль</label>
            <input class="user-input" type="password" name="password" placeholder="Введіть пароль">   
        </div>
        <div>
            <label class="sign-in">Підтвердження пароля</label>
            <input class="user-input" type="password" name="password_confirm" placeholder="Підтвердіть пароль">
        </div>
        
         <div>
      <input type="submit" value="Зареєструватись">
    </div>
        <p class="sign-in">
            У вас уже есть аккаунт? - <a class="sign-in" href="/">авторизируйтесь</a>
        </p>
        <?php
            if ($_SESSION['message']) {
                echo '<p class="sign-in> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
</div>

</body>
</html>