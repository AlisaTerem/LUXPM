<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Пользователь уже вошел в систему, перенаправляем его на главную страницу
    header("Location: luxPM.php");
    exit;
}

    require __DIR__ . '/header.php';
?>
   <div class="wrapper">
      <div class="login flex-col">
          <h3>Регистрация прошла успешно</h3>
          <p>Для входа в систему нажми <a href="login.php" class="link link-accent">сюда</a>
      </div>
    </p>
   </div>
<?php
    require __DIR__ . '/footer.php';
?>
    