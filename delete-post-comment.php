<?php
include_once "classes/DB.php";

use Classes\DB;

if(isset($_GET['comment-id'])) {
    $db = new DB("localhost", "root", "", "portalove_ext", "3306");

    $delete = $db->deletePostComment($_GET['comment-id']);

    if($delete) {
        header("Location: post.php?id=".$_GET['post-id']);
    } else {
        echo "Komentar neodstraneny";
    }
} else {
    header("Location: index.php");
}