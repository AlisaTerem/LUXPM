<?php
session_start();
$mysli = require __DIR__ . "/database.php";

require __DIR__ . '/header.php';
?>
<?php
$sql = sprintf("SELECT * FROM prais_list WHERE mastera_id='1' OR mastera_id='2'");
$result = $mysli->query($sql);
$prais_list = $result->fetch_all();
?>

<div class="wrapper price flex-col">
    <h1>Прайс-лист салона LUX PM</h1>
    <div class="flex-col price-block">
        <h2>Парикмахерские услуги</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="table__head-title">Вид услуги</th>
                    <th class="table__head-title">Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($prais_list) {
                    foreach ($prais_list as $prais) {
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