<?php
    session_start();

    include("./DB.class.php");
    $db = new DB();

    $res = $db->needHelp($_SESSION['id']);
    $_SESSION['help'] = true;
    $_SESSION['hid'] = $_SESSION['id'];

    echo '<script>window.location = "../../index.php"</script>';
?>