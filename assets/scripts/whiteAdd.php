<?php
    session_start();

    include("./DB.class.php");
    $db = new DB();

    $db->addWhite($_SESSION['id']);

    echo '<script>window.location = "../../index.php"</script>';
?>