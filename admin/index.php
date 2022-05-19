<?php
$auth = true;
if (!$auth) {
    header('location: /');
}

include_once "../connect.php";
include_once "../functions.php";

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
                <a href="/" class="acp__button">Выйти из ACP</a>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <section class="pages">
                <?php 
                if ($_POST['Title']) {
                    if (insertPost()) {
                        echo "Запись успешно добавлена";
                    } else {
                        echo "Ошибка в добавлении данных";
                    }
                }
                ?>
                <table border>
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Категория</th>
                            <th>Заголовок</th>
                            <th>Контент</th>
                            <th>Картинка</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody class="section-body">
                        <?php
                        $posts = $connect->query("SELECT * FROM `pages`;");
                        if ($posts->num_rows) {
                            while($post = $posts->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?php echo $post->id; ?></td>
                                    <td><?php echo $post->category; ?></td>
                                    <td><?php echo $post->title; ?></td>
                                    <td><?php echo $post->content; ?></td>
                                    <td><?php echo $post->thumbnail; ?></td>
                                    <td>
                                        <a href="../functions.php?operation=delete&id=<?php echo $post->id ?>">Удалить</a>
                                        <a href="edit.php?id=<?php echo $post->id; ?>">Изменить</a>
                                    </td>
                                </tr>
                <?php       }
                        }
                        ?>
                        
                    </tbody>
                </table>
            </section>

            <section class="add-page">
                <h2 class="section-title">Добавить запись</h2>
                <form enctype="multipart/form-data" class="add-page__form" action="http://php.test/admin/" method="POST">
                    <input type="text" name="Title" placeholder="Заголовок...">
                    <input type="text" name="Category" placeholder="Категория...">
                    <textarea cols="30" rows="10" name="Content" placeholder="Контент..."></textarea>
                    <input type="file" name="Thumbnail">
                    <input type="submit" value="Создать" class="form__button">
                </form>
            </section>
        </div>
    </main>
</body>
</html>