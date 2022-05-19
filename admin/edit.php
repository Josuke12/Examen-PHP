<?php
$auth = true;
if (!$auth) {
    header('location: /');
}

include_once "../connect.php";
include_once "../functions.php";

$id = $_GET["id"];

$Title = $connect->real_escape_string(trim($_POST["Title"]));
$Content = $connect->real_escape_string(trim($_POST["Content"]));
$Category = $connect->real_escape_string(trim($_POST["Category"]));

if($Title) {
    $update = sprintf("UPDATE `pages` SET `title` = '%s', `content` = '%s', `category` = '%s' WHERE `id` = $id",
       $Title, $Content, $Category);
    $connect->query($update);
    header('Location: http://php.test/admin/');
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="acp">
                <h1 class="acp__logo">Admin Control Panel</h1>
                <a href="index.html" class="acp__button">Выйти из ACP</a>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <section class="add-page">
                <h2 class="section-title">Редактировать запись</h2>
                <form enctype="multipart/form-data" action="../functions.php?operation=update&id=<?php echo $post->id ?>" class="add-page__form" method="POST">
                    <?php 
                    $posts = $connect->query("SELECT * FROM `pages` WHERE `id` = $id LIMIT 1;");
                    if($posts->num_rows) {
                        $post = $posts->fetch_object(); ?>
                        <input type="text" name="Title" placeholder="Заголовок..." value="<?php echo $post->title; ?>">
                        <input type="text" name="Category" placeholder="Категория..." value="<?php echo $post->category; ?>">
                        <textarea cols="30" rows="10" name="Content" placeholder="Контент..."><?php echo $post->content; ?></textarea>
                        <input type="file" name="Thumbnail" value="<?php echo $post->thumbnail; ?>">
                        <input type="submit" value="Изменить" class="form__button">
            <?php   }
                    else {
                        ?>
                        <p style="font-size: 2.3rem;">Запись не найдена. <a style="text-decoration: underline;" href="http://php.test/admin/">Вернуться в админку</a></p>
            <?php   }
                    ?>
                </form>
            </section>
        </div>
    </main>
</body>
</html>