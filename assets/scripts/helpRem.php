<?php
    session_start();

    include("./DB.class.php");
    $db = new DB();

    $db->noHelp($_SESSION['id']);
    $_SESSION['help'] = false;

    echo '<script>window.location = "../../index.php"</script>';
?>