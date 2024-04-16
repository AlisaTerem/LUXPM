<?php
$mysqli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

require __DIR__ . '/header.php';
?>

<div class="wrapper about">
	<div class="text-center">
		<?php if (!isset($_GET['master_id'])) : ?>
			<h2>Выберите мастера</h2>
			<div class="flex">
				<div class="quote link w-auto">
					<span>Парикмахерские услуги</span>
					<a href="zapisat.php?master_id=1">
						<img src="img\Alisa.jpg" class="image">
					</a>
				</div>
				<div class="quote link w-auto">
					<span>Перманентный макияж</span>
					<a href="zapisat.php?master_id=2">
						<img src="img\geka.jpg" class="image">
					</a>
				</div>
			</div>

			<?php else : ?>
				<h2>Выберите услугу</h2>
				<form action="save.php" method="post" class="flex-col form gap-1 text-left">
					<div class="flex justify-between quote">
						<span>Услуга</span>
						<select class="form-block__input">
							<?php
							$sql = sprintf("SELECT * FROM prais_list WHERE mastera_id='{$_GET['master_id']}'");
							$result = $mysqli->query($sql);
							$prais_list = $result->fetch_all();
							?>
							<?php foreach ($prais_list as $item) : ?>
								<option value="<?= $item[0]; ?>"><?= $item[1]; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="flex justify-between quote">
						<span>Дата</span>
						<input type="date" id="start" name="trip-start" class="form-block__input" />
					</div>
					<div class="flex justify-between quote">
						<span>Время:</span>
						<input type="time" id="time" name="time" class="form-block__input" />
					</div>
					<button class="link button" type="submit">Сохранить</button>
				</form>
			<?php endif; ?>
			
	</div>
</div>

<?php
require __DIR__.'/footer.php'; 
?>
