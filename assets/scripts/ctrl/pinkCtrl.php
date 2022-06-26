<?php
    session_start();

    include("../DB.class.php");
    $db = new DB();

    if (isset($_GET['id']) && isset($_GET['quan'])) {
        $res = $db->updPink($_GET['id'], $_GET['quan']);
    }
    echo '<script>window.location = "../../../index.php"</script>';
?>