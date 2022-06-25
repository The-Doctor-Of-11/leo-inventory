<?php
    session_start();
    $_SESSION['id'] = $_POST['location'];
    echo '<script>window.location = "../../index.php"</script>';
?>