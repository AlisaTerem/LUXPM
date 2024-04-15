<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Пользователь уже вошел в систему, перенаправляем его на главную страницу
    header("Location: luxPM.php");
    exit;
}

$is_invalid= false;
$mysli = require __DIR__ . "/database.php";
if($_SERVER["REQUEST_METHOD"]=== "POST"){
   $sql= sprintf("SELECT * FROM users
   WHERE e_mail= '%s'",
  $mysli->real_escape_string ($_POST["e_mail"]));
  $result= $mysli->query($sql);
  $user=$result->fetch_assoc();
  if($user){
   if(password_verify($_POST["password"] , $user["password_hash"])) {
        session_regenerate_id();
        $_SESSION["user_id"]=$user["id"];
        header("Location: luxPM.php");
        exit;
   }
  }
  $is_invalid= true;
}

require __DIR__ . '/header.php';
?>


<div class="wrapper flex-col login">
    <h2>Вход</h2>
    <?php if($is_invalid): ?>
    <em>Логин недействительный</em>
    <?php endif; ?>
    <form method="post" class="flex-col form">
        <div class="flex-col form-block">
            <input type="email" name="e_mail" id="e_mail" placeholder="Email" class="form-block__input" value="<?= htmlspecialchars($_POST["e_mail"] ?? "") ?>">
        </div>
        <div class="flex-col form-block">
            <input type="password" name="password" id="password" placeholder="Пароль" class="form-block__input">
        </div>
        <button class="button link">Войти</button>
    </form>
</div>

<?php
require __DIR__ . '/footer.php';
?>