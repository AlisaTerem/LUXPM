<?php
session_start();
$mysli = require __DIR__ . "/database.php";

require __DIR__ . '/header.php';
?>
<?php
$sql1 = sprintf("SELECT * FROM prais_list WHERE mastera_id='1'");
$result1 = $mysli->query($sql1);
$prais_list1 = $result1->fetch_all();

$sql2 = sprintf("SELECT * FROM prais_list WHERE mastera_id='2'");
$result2 = $mysli->query($sql2);
$prais_list2 = $result2->fetch_all();
?>

<div class="wrapper price flex-col">
    <h1>Прайс-лист салона LUX PM</h1>
    <div class="flex-col price-block">
        <h2>Парикмахерские услуги Мастера Алисы</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="table__head-title">Вид услуги</th>
                    <th class="table__head-title">Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($prais_list1) {
                    foreach ($prais_list1 as $prais) {
                ?>
                    <tr>
                        <td class="table__body-row"><?= $prais[1]; ?></td>
                        <td class="table__body-row"><?= $prais[4]; ?></td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="flex-col price-block">
        <h2>Прайс-лист Мастера Евгении</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="table__head-title">Вид услуги</th>
                    <th class="table__head-title">Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($prais_list2) {
                    foreach ($prais_list2 as $prais) {
                ?>
                    <tr>
                        <td class="table__body-row"><?= $prais[1]; ?></td>
                        <td class="table__body-row"><?= $prais[4]; ?></td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>



    <div>
        <div class="grid">
            <div class="grid-element grid-center">
                <span>Консультация бесплатно</span>
            </div>
            <div class="grid-element grid-center">
                <span>Тест-пряди бесплатно</span>
            </div>
        </div>
    </div>

    <p>Цена может быть выше или ниже указанной в прайсе в зависимости от густоты волос и сложности исполнения работы.</p>
    <p>Окончательную цену обсуждайте с мастером на консультации. </p>
</div>

<?php
require __DIR__.'/footer.php'; 
?>