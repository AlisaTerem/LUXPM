<?php
require_once 'includes/header.php';
get_header();
?>

<div class="wrapper price flex-col">
    <h1>Прайс-лист салона LUX PM</h1>
    <div class="flex-col price-block">
        <h2>Парикмахерские услуги </h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="table__head-title">Вид услуги</th>
                    <th class="table__head-title">Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $price = database::query("SELECT title,stoimost FROM prais_list WHERE mastera_id='1'");
                if ($price) {
                    foreach ($price as $prais) {
                ?>
                        <tr>
                            <td class="table__body-row"><?= $prais['title']; ?></td>
                            <td class="table__body-row"><?= $prais['stoimost']; ?></td>
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
                <span>Тест-пряди 300 рублей</span>
            </div>
        </div>
    </div>
    <p>Цена может быть ВЫШЕ или НИЖЕ указанной в прайсе в зависимости от густоты волос и сложности исполнения работы.</p>
    <p>Окончательную цену обсуждайте с мастером на консультации. </p>
    <div class="flex-col price-block">
        <h2>Перманентный Макияж</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="table__head-title">Вид услуги</th>
                    <th class="table__head-title">Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $price = database::query("SELECT title,stoimost FROM prais_list WHERE mastera_id='2'");
                if ($price) {
                    foreach ($price as $prais) {
                ?>
                        <tr>
                            <td class="table__body-row"><?= $prais['title']; ?></td>
                            <td class="table__body-row"><?= $prais['stoimost']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php
get_footer();
?>