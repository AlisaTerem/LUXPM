<?php
require_once 'includes/header.php';
if (!user::id()) {
	header("Location: /login.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$usluga = database::query("SELECT * FROM prais_list WHERE id={$_POST["category_id"]}", true);

	$dts = $_POST["trip-start"] . " " . $_POST["time"] . ':00'; // время начала услуги
	$dtf = date('Y-m-d H:i:s', strtotime($dts) + (int)$usluga['time'] * 60);

	if ($dts < date('Y-m-d H:i:s')) {
		header("location: zapisat.php?master_id={$_POST['master_id']}&error=Запись на прошедшие периоды недоступна!");
		exit;
	}

	// наложение времени выбранное,с тем которое заняли
	$count = (int)database::query("SELECT COUNT(*) as count FROM zayavka WHERE mastera_id='{$_POST["master_id"]}' AND ((vremya_nachala<'{$dts}' AND vremya_okonchania > '{$dts}') OR (vremya_nachala<'{$dtf}' AND vremya_okonchania > '{$dtf}')) ", true)[0];

	if ($count > 0) {
		header("location: zapisat.php?master_id={$_POST['master_id']}&error=Данное время занято! Выбирите другое время!");
		exit;
	}

	$result = database::basic_query("INSERT INTO zayavka( prais_id, vremya_nachala,vremya_okonchania, users_id, mastera_id) VALUE('{$_POST["category_id"]}','{$dts}','{$dtf}','" . user::id() . "','{$_POST["master_id"]}')");

	if ($result) {
		header("location: lk.php");
	} else {
		header("location: zapisat.php?master_id={$_POST['master_id']}&error=Что-то пошло не так! Повторите попытку позже, или запишитесь по телефону!");
	}
	exit;
}

get_header();
?>

<div class="wrapper about">
	<div class="text-center">
		<?php if (!isset($_GET['master_id'])) : ?>
			<h2>Выберите мастера</h2>
			<div class="flex">
				<div class="quote link w-auto">
					<span>Парикмахерские услуги</span>
					<a href="zapisat.php?master_id=1">
						<img src="/assets/images/AT.jpg" class="image">
					</a>
				</div>
				<div class="quote link w-auto">
					<span>Перманентный макияж</span>
					<a href="zapisat.php?master_id=2">
						<img src="/assets/images/geka.jpg" class="image">
					</a>
				</div>
			</div>

		<?php else : ?>
			<?php if (isset($_GET['error'])) : ?>
				<h3><?= $_GET['error']; ?></h3>
			<?php endif; ?>
			<h2>Выберите услугу</h2>
			<form method="post" class="flex-col form gap-1 text-left">
				<input type="hidden" name="master_id" value="<?= $_GET['master_id'] ?>">
				<div class="flex justify-between quote">
					<span>Услуга</span>
					<select class="form-block__input" name="category_id">
						<?php
						$result = database::query("SELECT * FROM prais_list WHERE mastera_id='{$_GET['master_id']}'");
						?>
						<?php foreach ($result as $item) : ?>
							<option value="<?= $item['id']; ?>"><?= $item['title']; ?></option>
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
get_footer();
?>