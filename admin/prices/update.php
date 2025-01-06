<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

$id = database::escape_string($_GET['id']);
$item = database::query("SELECT * FROM prices WHERE id='{$id}'", true);

if (!$item) {
    header("location: /admin/prices.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = database::escape_string($_POST["title"]);
    $type  = database::escape_string($_POST["type"]);
    $cost  = database::escape_string($_POST["cost"]);
    $price = database::escape_string($_POST["price"]);

    $result = database::basic_query("UPDATE prices SET title='{$title}', `type`='{$type}', cost='{$cost}', price='{$price}' WHERE id='{$id}'");

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
            <input type="text" name="title" id="title" placeholder="Наименование" class="form-block__input" value="<?= $item['title'] ?>" required>
        </div>
        <div class="flex-col form-block">
            <select name="type" id="type" class="form-block__input" required>
                <option value="1" <?= $item['type'] == 1 ? 'selected' : '' ?>>Товар</option>
                <option value="2" <?= $item['type'] == 2 ? 'selected' : '' ?>>Услуга</option>
            </select>
        </div>
        <div class="flex-col form-block">
            <input type="text" name="cost" id="cost" placeholder="Себестоимость единицы" class="form-block__input" value="<?= $item['cost'] ?>" required>
        </div>
                <div class="flex-col form-block">
            <input type="text" name="price" id="price" placeholder="Цена за единицу" class="form-block__input" value="<?= $item['price'] ?>" required>
        </div>
        <button class="button link">Сохранить</button>
    </form>
</div>

<?php
get_footer();
?>