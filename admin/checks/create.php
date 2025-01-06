<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id = database::escape_string($_POST["user_id"]);
    $master_id = database::escape_string($_POST["master_id"]);

    $result = database::basic_query("INSERT INTO checks( user_id, master_id) VALUE('{$user_id}', '{$master_id}')");

    if ($result) {
        $cost = 0;
        $total = 0;
        $id = database::last_id();
        for ($i = 0; $i < 10; $i++) {
            if ($_POST['prices_id'][$i] == 0) {
                break;
            }
            $prices_id = database::escape_string($_POST["prices_id"][$i]);
            $count = database::escape_string($_POST["count"][$i]);
            database::basic_query("INSERT INTO checks_positions ( check_id, prices_id, count) VALUE('{$id}', '{$prices_id}', '{$count}')");
            $info = database::query("SELECT * FROM prices WHERE id='{$prices_id}'", true);
            $cost += $info['cost'] * $count;
            $total += $info['price'] * $count;
        }
        database::basic_query("UPDATE checks SET cost='{$cost}', total='{$total}' WHERE id='{$id}'");
        header("location: /admin/checks.php");
        exit;
    } else {
        die(database::error());
    }
}

$users = database::query("SELECT * FROM users");

$clients = [];
$masters = [];

foreach ($users as $user) {
    if ($user['is_master'] == 1) {
        $masters[] = $user;
    } else {
        $clients[] = $user;
    }
}

$prices = database::query("SELECT * FROM prices");

get_header();
?>

<div class="wrapper about flex-col">
    <form method="post" class="flex-col form__large">
        <div class="flex-col form-block">
            <select name="user_id" id="user_id" class="form-block__input" required>
                <?php foreach ($clients as $client) : ?>
                    <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex-col form-block">
            <select name="master_id" id="master_id" class="form-block__input" required>
                <?php foreach ($masters as $master) : ?>
                    <option value="<?= $master['id'] ?>"><?= $master['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php for ($i = 0; $i < 10; $i++) : ?>
            <div class="flex-col form-block">
                <div class="flex">
                    <select name="prices_id[<?= $i ?>]" id="master_id[<?= $i ?>]" class="form-block__input">
                        <option value="0">Нет</option>
                        <?php foreach ($prices as $price) : ?>
                            <option value="<?= $price['id'] ?>"><?= $price['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="count[<?= $i ?>]" class="form-block__input">
                </div>

            </div>
        <?php endfor; ?>

        <button class="button link">Сохранить</button>
    </form>
</div>

<?php
get_footer();
?>