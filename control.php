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

        <div class="vertSpace"></div>

        <!-- Storage Inventory -->
        <div class='outline'>
            <h2 style="text-decoration: underline;">Current Inventory: Storage</h2>
            <div class='opwrapper'>
                <h3>Ice Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(1);

                echo "<h3> {$data['Ice']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/iceCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="1" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Lemon Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Lemons']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/lemCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="1" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Pink Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Pink']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/pinkCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="1" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>White Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(1);

                echo "<h3> {$data['White']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/whiteCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="1" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Cups Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(1);

                echo "<h3> {$data['Cups']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/cupCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="1" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
        </div>
        <div class="vertSpace"></div>

        <!-- White House Inventory -->
        <div class='outline'>
            <h2 style="text-decoration: underline;">Current Inventory: White House</h2>
            <div class='opwrapper'>
                <h3>Ice Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(2);

                echo "<h3> {$data['Ice']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/iceCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="2" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Lemon Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Lemons']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/lemCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="2" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Pink Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Pink']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/pinkCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="2" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>White Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(2);

                echo "<h3> {$data['White']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/whiteCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="2" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Cups Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(2);

                echo "<h3> {$data['Cups']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/cupCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="2" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
        </div>
        <div class="vertSpace"></div>

        <!-- Lemonade Big Inventory -->
        <div class='outline'>
            <h2 style="text-decoration: underline;">Current Inventory: Lemonade Big</h2>
            <div class='opwrapper'>
                <h3>Ice Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(3);

                echo "<h3> {$data['Ice']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/iceCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="3" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Lemon Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Lemons']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/lemCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="3" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Pink Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Pink']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/pinkCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="3" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>White Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(3);

                echo "<h3> {$data['White']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/whiteCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="3" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Cups Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(3);

                echo "<h3> {$data['Cups']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/cupCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="3" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
        </div>
        <div class="vertSpace"></div>

        <!-- Lemonade Little Inventory -->
        <div class='outline'>
            <h2 style="text-decoration: underline;">Current Inventory: Lemonade Little</h2>
            <div class='opwrapper'>
                <h3>Ice Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(4);

                echo "<h3> {$data['Ice']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/iceCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="4" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Lemon Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Lemons']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/lemCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="4" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Pink Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                echo "<h3> {$data['Pink']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/pinkCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="4" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>White Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(4);

                echo "<h3> {$data['White']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/whiteCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="4" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
            <hr>
            <div class='opwrapper'>
                <h3>Cups Remaining: </h3>
                <div class="horizSpace"></div>
                <?php
                $data = $db->getData(4);

                echo "<h3> {$data['Cups']} Bag(s) </h3>";
                ?>
                <form action='./assets/scripts/ctrl/cupCtrl.php' class="formLine">
                    <input type="text" name="quan" class="inVal" />
                    <button name="id" value="4" type="submit" class="plsBtn">Update</button>
                </form>
            </div>
        </div>
        <div class="vertSpace"></div>   

    </div>
</body>