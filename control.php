<?php
session_start();
include("./assets/scripts/DB.class.php");
$db = new DB();
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 1;
}
else if ($_SESSION['id'] != 0) {
    echo '<script>window.location = "./index.php"</script>';
}
?>

<head>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="centerContent">
        <h1>Leo Lemonade Inventory Tracker</h1>
        <?php
        echo "<h2>Your Current Location: {$db->getName($_SESSION['id'])}</h2>";
        ?>
        <div class='vertSpace'></div>
        <hr>
        <div class='vertSpace'></div>

        <form action='./assets/scripts/locUpdate.php' method='post'>
            <select class="form-control" id="location" id="location" name="location">
                <option disabled="disabled" selected="true">Change Location</option>
                <option value="0">Operations</option>
                <option value="1">Storage Space</option>
                <option value="2">White House</option>
                <option value="3">Lemonade Big</option>
                <option value="4">Lemonade Little</option>
            </select>
            <input type='submit' value='Submit' class='upd'>
        </form>

        <div class='vertSpace'></div>

        <div style='border: 2px solid red'>
            <?php
                $help = $db->getHelp();

                if ($help == null) {
                    echo '<h3>No Locations Need Help!</h3>';
                }
                else {
                    echo $help;
                }
            ?>
        </div>

        <!-- Add Output for All Locations Current Inventory Levels HERE! -->

    </div>
</body>