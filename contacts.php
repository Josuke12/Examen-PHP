<?php
include_once "connect.php";

$contact = $connect->query("SELECT * FROM `pages` WHERE `category` = 'Контакты';");

if($contact->num_rows) {
	$cont = $contact->fetch_object();
	$myTitle = $cont->title;
} else {
	$myTitle = "Нет записей";
}


$header = file_get_contents("include/header.php");
$footer = file_get_contents("include/footer.php");

echo $header;
?>
<main class="main">
	<div class="container">
		<section class="contacts">
			<h3 class="title"><?php echo $myTitle; ?></h3>
			<div class="contacts__content page-new">
				<div class="contacts__text">
					<?php echo $cont->content; ?>
				</div>
				<div class="contacts__img">
					<img src="<?php echo $cont->thumbnail; ?>" alt="">
				</div>
			</div>
		</section>
	</div>
</main>
<?php echo $footer; ?>