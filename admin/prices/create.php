<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = database::escape_string($_POST["title"]);
    $type  = database::escape_string($_POST["type"]);
    $cost  = database::escape_string($_POST["cost"]);
    $price = database::escape_string($_POST["price"]);

    $result = database::basic_query("INSERT INTO prices( title, `type`, cost, price) VALUE('{$title}', '{$type}', '{$cost}', '{$price}')");

    if ($result) {
        header("location: /admin/prices.php");
        exit;
    } else {
        die(database::error());
    }
}

get_header();
?>

<div class="wrapper about flex-col">
    <form method="post" class="flex-col form">
        <div class="flex-col form-block">
            <input type="text" name="title" id="title" placeholder="Наименование" class="form-block__input" value="<?= htmlspecialchars($_POST["title"] ?? "") ?>" required>
        </div>
        <div class="flex-col form-block">
            <select name="type" id="type" class="form-block__input" required>
                <option value="1">Товар</option>
                <option value="2">Услуга</option>
            </select>
        </div>
        <div class="flex-col form-block">
            <input type="text" name="cost" id="cost" placeholder="Себестоимость единицы" class="form-block__input" value="<?= htmlspecialchars($_POST["cost"] ?? "") ?>" required>
        </div>
        <div class="flex-col form-block">
            <input type="text" name="price" id="price" placeholder="Цена за единицу" class="form-block__input" value="<?= htmlspecialchars($_POST["price"] ?? "") ?>" required>
        </div>
        <button class="button link">Добавить</button>
    </form>
</div>

<?php
get_footer();
?>