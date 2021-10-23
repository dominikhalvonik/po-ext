<?php
include_once "classes/DB.php";

use Classes\DB;

if(isset($_POST['submit'])) {
    $db = new DB("localhost", "root", "", "portalove_ext", "3306");

    $postId = $_POST['post_id'];
    $content = $_POST['message'];
    $username = $_POST['name'];

    $insert = $db->insertPostComment($postId, $username, $content);

    if($insert) {
        header("Location: post.php?id=".$postId);
    } else {
        echo "Komentar neulozeny";
    }
} else {
    echo "Formular neodoslany";
}