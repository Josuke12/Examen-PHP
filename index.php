<?php 
include_once "connect.php";

$posts = $connect->query("SELECT * FROM `pages` WHERE `category` = 'Главная';");

if($posts->num_rows) {
	$post = $posts->fetch_object();
	$myTitle = $post->title;
} else {
	$myTitle = "Нет записей";
}

$header = file_get_contents("include/header.php");
$footer = file_get_contents("include/footer.php");

echo $header;
?>

<main class="main">
	<div class="container">
		<section class="about">
			<h3 class="title"><?php echo $myTitle; ?></h3>
			<div class="about__content">
				<div class="content">
					<?php echo $post->content; ?>
				</div>
				<div class="about__img">
					<img src="<?php echo $post->thumbnail; ?>" alt="Изображение">
				</div>
			</div>
		</section>

		<?php
		$contact = $connect->query("SELECT `title`, `content` FROM `pages` WHERE `category` = 'Контакты';");

		if($contact->num_rows) {
			$cont = $contact->fetch_object();
			$myTitle = $cont->title;
		} else {
			$myTitle = "Нет записей";
		}
		?>
		<section class="contacts">
			<h3 class="title"><?php echo $myTitle; ?></h3>
			<div class="contacts__content">
				<?php echo $cont->content; ?>
			</div>
		</section>
	</div>
</main>
<?php echo $footer; ?>