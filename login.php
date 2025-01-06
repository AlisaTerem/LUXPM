<?php
require_once 'includes/header.php';
if (user::id()) {
    header("Location: /lk.php");
    exit;
}
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = database::escape_string($_POST["e_mail"]);
    $password = md5($_POST['password']);
    $user = database::query("SELECT * FROM users WHERE e_mail='{$email}' AND password_hash='{$password}'", true);
    if ($user) {
        setcookie('user_id', $user['id'], time() + 60 * 60 * 24 * 30);
        header("Location: /lk.php");
        exit;
    }
    $is_invalid = true;
}
get_header();
?>

<div class="wrapper flex-col login">
    <h2>Вход</h2>
    <?php if ($is_invalid): ?>
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
        <a href="/register.php" class="link button">Зарегистрироваться</a>
    </form>
</div>

<?php
get_footer();
?>