<?php
    session_start();

    include("./DB.class.php");
    $db = new DB();

    $db->addIce($_SESSION['id']);

    echo '<script>window.location = "../../index.php"</script>';
?>