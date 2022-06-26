<?php
    session_start();

    include("../DB.class.php");
    $db = new DB();

    if (isset($_GET['id']) && isset($_GET['quan'])) {
        $res = $db->updCups($_GET['id'], $_GET['quan']);
    }
    echo '<script>window.location = "../../../index.php"</script>';
?>