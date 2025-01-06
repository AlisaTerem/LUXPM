<?php
require_once 'includes/header.php';
if (user::id()) {
    header("Location: /lk.php");
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    var_dump($_POST);

    $name = database::escape_string(trim($_POST['name']));
    $e_mail = database::escape_string($_POST['e_mail']);


    if (database::query("SELECT * FROM users WHERE name='{$name}'", true)) {
        $errors[] = 'Пользователь с таким именем уже существует';
    }

    if (database::query("SELECT * FROM users WHERE e_mail='{$e_mail}'", true)) {
        $errors[] = 'Пользователь с такой почтой уже существует';
    }

    if (strlen($_POST["password"]) < 6) {
        $errors[] = 'Длинна пароля должна быть не менее 6 символов';
    }
    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = 'Пароль должен содержать буквы англиского языка';
    }
    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $errors[] = 'Пароль должен содержать цифры';
    }
    if ($_POST["password"] !== $_POST["password_confimation"]) {
        $errors[] = 'Пароли должны совпадать';
    }

    $phone = database::escape_string($_POST['phone']);
    $password = database::escape_string(md5($_POST['password']));

    if (empty($errors)) {


        $result = database::basic_query("INSERT INTO users(name, e_mail,phone, password_hash) VALUE('{$name}','{$e_mail}','{$phone}','{$password}')");

        if ($result) {
            setcookie('user_id', database::last_id(), time() + 60 * 60 * 24 * 30);
            header("location: /login.php");
            exit;
        }
    }
}

get_header();
?>

<div class="wrapper flex-col login">
    <h2>Регистрация</h2>
    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <div><?= $error; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <form method="post" class="flex-col form">
        <div class="flex-col form-block">
            <input type="text" id="name" name="name" class="form-block__input" placeholder="Имя" required>
        </div>
        <div class="flex-col form-block">
            <input type="email" id="e_mail" name="e_mail" class="form-block__input" placeholder="Email" required>
        </div>
        <div class="flex-col form-block">
            <input type="phone" id="phone" name="phone" class="form-block__input" placeholder="Телефон" required>
        </div>
        <div class="flex-col form-block">
            <input type="password" id="password" name="password" class="form-block__input" placeholder="Пароль" required>
        </div>
        <div class="flex-col form-block">
            <input type="password" id="password_confimation" name="password_confimation" class="form-block__input" placeholder="Подтверждение пароля" required>
        </div>
        <button class="button link">Регистрация</button>
    </form>
</div>

<?php
get_footer();
?>