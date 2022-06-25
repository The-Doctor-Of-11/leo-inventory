<?php
session_start();
include("./assets/scripts/DB.class.php");
$db = new DB();
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 1;
}
else if ($_SESSION['id'] == 0) {
    echo '<script>window.location = "./control.php"</script>';
}
if (!isset($_SESSION['help'])) {
    $_SESSION['help'] = false;
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

        <?php
            if ($_SESSION['id'] != 1) {
                if ($_SESSION['help'] == false) {
                    echo "<form action='./assets/scripts/helpAdd.php'><input type='submit' name='button1' class='minbtn' value='Request Help!' /></form>";
                }
                else if ($_SESSION['help'] == true && $_SESSION['id'] == $_SESSION['hid']) {
                    echo "<form action='./assets/scripts/helpRem.php'><input type='submit' name='button1' class='plsbtn' value='Cancel Help Request' /></form>";
                }
                else {
                    echo "<form action='./assets/scripts/helpAdd.php'><input type='submit' name='button1' class='minbtn' value='Request Help!' /></form>";
                }
            }
        ?>

        <div class='wrapper'>
            <h3>Ice Remaining: </h3>
            <form action='./assets/scripts/iceAdd.php'>
                <input type="submit" name="button1" class="plsbtn" value="+" />
            </form>

            <?php
            $data = $db->getData($_SESSION['id']);

            echo "<h3> {$data['Ice']} Bag(s) </h3>";
            ?>

            <form action='./assets/scripts/iceRem.php'>
                <input type="submit" name="button1" class="minbtn" value="-" />
            </form>
        </div>

        <div class='wrapper'>
            <h3>Lemon Bags Remaining: </h3>
            <form action='./assets/scripts/lemAdd.php'>
                <input type="submit" name="button1" class="plsbtn" value="+" />
            </form>

            <?php
            $data = $db->getData($_SESSION['id']);

            echo "<h3> {$data['Lemons']} Bag(s) </h3>";
            ?>

            <form action='./assets/scripts/lemRem.php'>
                <input type="submit" name="button1" class="minbtn" value="-" />
            </form>
        </div>

        <div class='wrapper'>
            <h3>Pink Bags Remaining: </h3>
            <form action='./assets/scripts/pinkAdd.php'>
                <input type="submit" name="button1" class="plsbtn" value="+" />
            </form>

            <?php
            $data = $db->getData($_SESSION['id']);

            echo "<h3> {$data['Pink']} Bag(s) </h3>";
            ?>

            <form action='./assets/scripts/pinkRem.php'>
                <input type="submit" name="button1" class="minbtn" value="-" />
            </form>
        </div>

        <div class='wrapper'>
            <h3>White Bags Remaining: </h3>
            <form action='./assets/scripts/whiteAdd.php'>
                <input type="submit" name="button1" class="plsbtn" value="+" />
            </form>

            <?php
            $data = $db->getData($_SESSION['id']);

            echo "<h3> {$data['White']} Bag(s) </h3>";
            ?>

            <form action='./assets/scripts/whiteRem.php'>
                <input type="submit" name="button1" class="minbtn" value="-" />
            </form>
        </div>

        <div class='wrapper'>
            <h3>Cup Bags Remaining: </h3>
            <form action='./assets/scripts/cupAdd.php'>
                <input type="submit" name="button1" class="plsbtn" value="+" />
            </form>

            <?php
            $data = $db->getData($_SESSION['id']);

            echo "<h3> {$data['Cups']} Bag(s) </h3>";
            ?>

            <form action='./assets/scripts/cupRem.php'>
                <input type="submit" name="button1" class="minbtn" value="-" />
            </form>
        </div>

    </div>
</body>