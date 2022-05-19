<?php
include_once "connect.php";

$holders = $connect->query("SELECT * FROM `pages` WHERE `category` = 'Илоний Маскович';");

if($holders->num_rows) {
	$holder = $holders->fetch_object();
	$holderTitle = $holder->title;
} else {
	$holderTitle = "Нет записи";
}

$header = file_get_contents("include/header.php");
$footer = file_get_contents("include/footer.php");

echo $header;
?>
<main class="main">
	<div class="container">
		<section class="holder">
			<h3 class="title"><?php echo $holderTitle; ?></h3>
			<div class="holder__content">
				<div class="holder__text">
					<?php echo $holder->content; ?>
				</div>
				<div class="holder__img">
					<img src="<?php echo $holder->thumbnail ?>" alt="Изображение">
				</div>
			</div>
		</section>
	</div>
</main>
<?php echo $footer; ?>