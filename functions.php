<?php
include_once "connect.php";
if ($_GET["operation"] == "delete") {
    deletePost();
}


function insertPost() {
    global $connect;
    $Title = $connect->real_escape_string(trim($_POST["Title"]));
    $Content = $connect->real_escape_string(trim($_POST["Content"]));
    $Category = $connect->real_escape_string(trim($_POST["Category"]));
    if (empty($_FILES["Thumbnail"]["name"])) {
        $Thumbnail = "";
    } else {
        $Thumbnail = "img/" . $_FILES["Thumbnail"]["name"];
        $fileTmpName = $_FILES["Thumbnail"]["tmp_name"];
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string) finfo_open($fi, $_FILES["Thumbnail"]["tmp_name"]);
        if (!(strpos($mime, 'image') === false)) {
            move_uploaded_file($fileTmpName, __DIR__ . '/img/' . $_FILES["Thumbnail"]["name"]);
        }
    }

    $insert_post = sprintf("
        INSERT INTO `pages` (`title`, `content`, `category`, `thumbnail`)
        VALUES ('%s', '%s', '%s', '%s');",
        $Title, $Content, $Category, $Thumbnail);
    
    if ($connect->query($insert_post)) {
        return true;
    } else {
        return false;
    }
}

function deletePost() {
    global $connect;
    $id = $_GET["id"];
    $connect->query("DELETE FROM `pages` WHERE `id` = $id");
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}