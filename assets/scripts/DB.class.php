<?php
class DB
{
    private $dbh;

    function __construct()
    {
        try {
            $this->dbh = mysqli_connect("localhost", "leo", "Leo123!", "leo");
        } catch (PDOException $pde) {
            echo $pde->getMessage();
        }
    }

    // ------------ SELECTS ---------------------------------------------------------------
    function getName($id) {
        if ($id == 0) {
            return "Operations";
        }
        else {
            if ($stmt = mysqli_query($this->dbh, "SELECT LocationName FROM Locations WHERE LocationID = $id;")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $res = $return["LocationName"];
                }
            } //end if
            return $res;
        }
        
    }

    function getData($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT * FROM Inventory WHERE LocID = $id;")) {
            return mysqli_fetch_assoc($stmt);
        }
    }

    function getHelp() {
        if ($stmt = mysqli_query($this->dbh, "SELECT LocID, Help, HelpTime FROM Inventory WHERE Help = 1;")) {
            $ret = "";
            while ($return = mysqli_fetch_assoc($stmt)) {
                $name = $this->getName($return["LocID"]);
                $time = $return['HelpTime'];

                $ret .= "<h1>$name Requested Help at $time!</h1>\n";
            }
            return $ret;
        }
    }

    // ------------ UPDATES ---------------------------------------------------------------

    function needHelp($id) {

        $dt = new DateTime("now", new DateTimeZone('America/New_York'));
        $ctime = $dt->format('H:i:s');

        $sql = "UPDATE Inventory SET Help = 1, HelpTime = '$ctime' WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }
    function noHelp($id) {
        $sql = "UPDATE Inventory SET Help = 0, HelpTime = null WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function addIce($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Ice FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Ice'] + 1;

            $sql = "UPDATE Inventory SET Ice = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function updIce($id, $quan) {
        $sql = "UPDATE Inventory SET Ice = $quan WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function updLem($id, $quan) {
        $sql = "UPDATE Inventory SET Lemons = $quan WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function updPink($id, $quan) {
        $sql = "UPDATE Inventory SET Pink = $quan WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function updWhite($id, $quan) {
        $sql = "UPDATE Inventory SET White = $quan WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function updCups($id, $quan) {
        $sql = "UPDATE Inventory SET Cups = $quan WHERE LocID = $id;";
        if (mysqli_query($this->dbh, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
            return false;
        }
    }

    function remIce($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Ice FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Ice'] - 1;

            if ($val < 1) {
                $val = 0;
            }

            $sql = "UPDATE Inventory SET Ice = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function addLem($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Lemons FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Lemons'] + 1;

            $sql = "UPDATE Inventory SET Lemons = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function remLem($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Lemons FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Lemons'] - 1;

            if ($val < 1) {
                $val = 0;
            }

            $sql = "UPDATE Inventory SET Lemons = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function addPink($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Pink FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Pink'] + 1;
    
            $sql = "UPDATE Inventory SET Pink = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }
    
    function remPink($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Pink FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Pink'] - 1;
    
            if ($val < 1) {
                $val = 0;
            }
    
            $sql = "UPDATE Inventory SET Pink = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function addWhite($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT White FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['White'] + 1;
    
            $sql = "UPDATE Inventory SET White = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }
    
    function remWhite($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT White FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['White'] - 1;
    
            if ($val < 1) {
                $val = 0;
            }
    
            $sql = "UPDATE Inventory SET White = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

    function addCup($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Cups FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Cups'] + 1;
    
            $sql = "UPDATE Inventory SET Cups = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }
    
    function remCup($id) {
        if ($stmt = mysqli_query($this->dbh, "SELECT Cups FROM Inventory WHERE LocID = $id;")) {
            $val = mysqli_fetch_assoc($stmt)['Cups'] - 1;
    
            if ($val < 1) {
                $val = 0;
            }
    
            $sql = "UPDATE Inventory SET Cups = $val WHERE LocID = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        } //end if
    }

}//end class DB
