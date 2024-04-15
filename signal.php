<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Пользователь уже вошел в систему, перенаправляем его на главную страницу
    header("Location: luxPM.php");
    exit;
}

    require __DIR__ . '/header.php';
?>
    <div class="wrapper flex-col login">
        <h2>Регистрация</h2>
        <form action="index.php" method="post" id="signal" novalidate class="flex-col form">
            <div class="flex-col form-block">
                <input type="text" id="name" name="name" class="form-block__input" placeholder="Имя">
            </div>
            <div class="flex-col form-block">
                <input type="email" id="e_mail" name="e_mail" class="form-block__input" placeholder="Email">
            </div>
            <div class="flex-col form-block">
                <input type="phone" id="phone" name="phone" class="form-block__input" placeholder="Телефон">
            </div>
            <div class="flex-col form-block">
                <input type="password" id="password" name="password" class="form-block__input" placeholder="Пароль">
            </div>
            <div class="flex-col form-block">
                <input type="password" id="password_confimation" name="password_confimation" class="form-block__input" placeholder="Подтверждение пароля">
            </div>
            <button class="button link">Регистрация</button>
        </form>
    </div>

<?php
    require __DIR__ . '/footer.php';
?>