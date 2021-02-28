<?php
if(isset($_GET['langue']) && isset($_GET['page'])){

    $page = $_GET['page'];
    header("Location: ".$page."?lang=".$_GET['langue']);
    exit;
}
?>