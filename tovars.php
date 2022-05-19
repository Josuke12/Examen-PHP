<?php
include_once "connect.php";

$tovars = $connect->query("SELECT * FROM `pages` WHERE `category` = 'Наши тракторы';");

$header = file_get_contents("include/header.php");
$footer = file_get_contents("include/footer.php");

echo $header;
?>
<main class="main">
	<div class="container">
		<section class="tovar">
			<h3 class="title">Тракторы</h3>
			<div class="tovar__content">
				<div class="tovar__items">
					<?php
					if($tovars->num_rows) {
						while($tovar = $tovars->fetch_object()) {?>
							<div class="tovar__item">
								<img src="<?php echo $tovar->thumbnail; ?>" alt="Изображение" class="personal__img">
								<p class="tovar__price">
									<?php echo $tovar->content; ?>
								</p>
								<p class="tovar__name">
									<?php echo $tovar->title;?>
								</p>
								<a class="tovar__button">
									Купить
								</a>
							</div>
						<?php } 
					}	?>
				</div>
			</div>
		</section>
	</div>
</main>
<?php echo $footer; ?>