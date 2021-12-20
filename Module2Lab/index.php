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
<script src="ChartJS.min.js"></script>
<body>

<!-- Форма авторизации -->

  <div class="wrapper">
  <div class="header">
    <h3 class="sign-in">Авторизація</h3>
    <div class="button">
        <a class="sign-in" href="/register.php">Зареєструватись</a>
    </div>
  </div>
   <div class="clear"></div> 
  <form method = "post" action="vendor/signin.php">
      <div>
        <input class="user-input" type="text" name="login" id="name" placeholder="Введіть ваше ім'я">
      </div> 
      <div>
        <input type="password" name="password" id="name" placeholder="Ваш пароль">
      </div> 
     <div>
      <input type="submit" value="Увійти">
    </div>
      <span class="forgot-label">
      <div class="clear"></div>
      <div>
        <?php
            if ($_SESSION['message']) {
                echo '<p class = "sign-in"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
            
        </div>
        
  </form>  
</div>

</body>
</html>