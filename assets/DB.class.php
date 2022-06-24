<?php
    class DB {
        private $dbh;

        function __construct(){
            try {
                $this->dbh = mysqli_connect("localhost","leo","Leo123!","leo");
            } catch(PDOException $pde) {
                echo $pde->getMessage();
            }
        }

        // ------------ SELECTS ---------------------------------------------------------------
        function getTopics() {
            $bigString = "<table id='table_id' class='display'><thead><tr><th>Subject</th><th>Topic</th><th>Link</th></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT subject, topic, idTopic FROM Topic")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $bigString .= "<tr><td>{$return['subject']}</td><td>{$return['topic']}</td><td><a class='tableButton' href=\"viewTopic.php?id={$return['idTopic']}\">View Discussion</a></td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }

        function getTopicsAdmin() {
            $bigString = "<table id='table_id' class='display'><thead><tr></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT * FROM Topic")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $userName = $this -> getUserByID($return['idUsr']);
                    $bigString .= "<tr><td>{$return['idTopic']}</td><td>{$return['idUsr']}</td><td>Submitted By {$userName}</td><td>{$return['subject']}</td><td>{$return['topic']}</td><td><a class='tableButton' href=\"../../viewTopic.php?id={$return['idTopic']}\">View Discussion</a></td><td><a class='tableButton' href=\"delTopic.php?id={$return['idTopic']}\">Delete</a></td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }
        function getCommentsAdmin() {
            $bigString = "<table id='table_id' class='display'><thead><tr></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT * FROM Comments")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $userName = $this -> getUserByID($return['idUsr']);
                    $bigString .= "<tr><td>{$return['idComment']}</td><td>{$return['idTopic']}</td><td>{$return['idUsr']}</td><td>Submitted By {$userName}</td><td>{$return['text']}</td><td><a class='tableButton' href=\"../../viewTopic.php?id={$return['idTopic']}\">View Discussion</a></td><td><a class='tableButton' href=\"delComment.php?id={$return['idComment']}\">Delete</a></td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }

        function getUsers() {
            $bigString = "<table id='table_id' class='display'><thead><tr></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT * FROM Users")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $bigString .= "<tr><td>{$return['idUsr']}</td><td>{$return['idRole']}</td><td>{$return['name']}</td><td>{$return['username']}</td><td>{$return['email']}</td><td><a class='tableButton' href=\"promoteUser.php?id={$return['idUsr']}\">Make Administrator</a></td><td><a class='tableButton' href=\"deleteUsr.php?id={$return['idUsr']}\">Delete</a></td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }

        function authUser($logquery) {
            if ($stmt = mysqli_query($this->dbh,"SELECT pwd FROM Users WHERE username = '$logquery' OR email = '$logquery'")) {
                return mysqli_fetch_assoc($stmt);
            }
        }
        function findUser($logquery) {
            if ($stmt = mysqli_query($this->dbh,"SELECT idUsr FROM Users WHERE username = '$logquery' OR email = '$logquery'")) {
                return mysqli_fetch_assoc($stmt);
            }
        }
        function findUserRole($logquery) {
            if ($stmt = mysqli_query($this->dbh,"SELECT idRole FROM Users WHERE username = '$logquery' OR email = '$logquery'")) {
                return mysqli_fetch_assoc($stmt);
            }
        }
        function findUserName($logquery) {
            if ($stmt = mysqli_query($this->dbh,"SELECT name FROM Users WHERE username = '$logquery' OR email = '$logquery'")) {
                return mysqli_fetch_assoc($stmt);
            }
        }
        function findUserEmail($logquery) {
            if ($stmt = mysqli_query($this->dbh,"SELECT email FROM Users WHERE username = '$logquery' OR email = '$logquery'")) {
                return mysqli_fetch_assoc($stmt);
            }
        }

        function getTopic($id) {
            if ($stmt = mysqli_query($this->dbh,"SELECT subject, topic, idUsr FROM Topic WHERE idTopic = $id")) {
                $userName = $this -> getUserByID($id);
                while ($return = mysqli_fetch_assoc($stmt)) {
                    echo "<h1>{$return['subject']}</h1>";
                    echo "<h4>Submitted By $userName</h4>";
                    echo "<h3>{$return['topic']}</h3>";
                }
            }
        }

        function getCommentsByID($id) {
            $bigString = "<table id='table_id' class='display'><thead><tr></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT text, idUsr FROM Comments WHERE idTopic = $id")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $userName = $this -> getUserByID($return['idUsr']);
                    $bigString .= "<tr><td>{$return['text']}</td><td>Submitted By {$userName}</td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }

        function getUserByID($id) {
            if ($stmt = mysqli_query($this->dbh,"SELECT name FROM Users WHERE idUsr = $id")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    return $return['name'];
                }
            }
        }

        function getPendingUsers() {
            $bigString = "<table id='table_id' class='display'><thead><tr></tr></thead><tbody>";
            if ($stmt = mysqli_query($this->dbh,"SELECT * FROM UserReq")) {
                while ($return = mysqli_fetch_assoc($stmt)) {
                    $bigString .= "<tr><td>{$return['idUsrReq']}</td><td>{$return['idRole']}</td><td>{$return['name']}</td><td>{$return['username']}</td><td>{$return['email']}</td><td><a class='tableButton' href=\"authUsr.php?id={$return['idUsrReq']}&idRole={$return['idRole']}&name={$return['name']}&pwd={$return['pwd']}&username={$return['username']}&email={$return['email']}&\">Approve</a></td><td><a class='tableButton' href=\"deAuthUsr.php?id={$return['idUsrReq']}&email={$return['email']}\">Deny</a></td></tr>";
                }//end while
                $bigString .= "</tbody></table>";
            }//end if
            return $bigString;
        }

        // ------------ INSERTS ---------------------------------------------------------------
        function submitUserReq($rid, $uname, $name, $email, $hpwd) {
            $sql = "INSERT INTO UserReq (idRole, name, pwd, username, email) VALUES ('$rid', '$name', '$hpwd', '$uname', '$email')";

            if (mysqli_query($this->dbh, $sql)) {

                $to = $email;
                $subject = "Account Request Submitted";
                $txt = "Your request for an account at aidanlemay.com/TackOverflow has been submitted.\n Feel free to revisit the site in the meantime while you wait on our deciscion and browse as a guest!\n You can always reply to this email or send a direct email to admin@aidanlemay.com with questions, comments, or concerns.\n Thank you!";
                $headers = "From: admin@aidanlemay.com" . "\r\n";
                mail($to,$subject,$txt,$headers);

                $to = "admin@aidanlemay.com";
                $subject = "New Account Request Recieved";
                $txt = "A new user has applied for an account - Please visit and make an authorization choice.";
                $headers = "From: admin@aidanlemay.com" . "\r\n";
                mail($to,$subject,$txt,$headers);

                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }

        function approveUser($id, $rid, $uname, $name, $email, $hpwd) {
            $sql = "INSERT INTO Users (idRole, name, pwd, username, email) VALUES ('$rid', '$name', '$hpwd', '$uname', '$email')";

            if (mysqli_query($this->dbh, $sql)) {
                $sql = "DELETE FROM UserReq WHERE idUsrReq = $id";
                if (mysqli_query($this->dbh, $sql)) {
                    $to = $email;
                    $subject = "Account Request Approved!";
                    $txt = "Congratulations!\n You have been approved for an account at aidanlemay.com/TackOverflow!\n Please revisit the site and log in with your credentials to enjoy the features of our application.\n You can always reply to this email or send a direct email to admin@aidanlemay.com with questions, comments, or concerns.\n Thank you!";
                    $headers = "From: admin@aidanlemay.com" . "\r\n";
                    mail($to,$subject,$txt,$headers);
                    return true;
                }
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                    return false;
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }
        
        function newTopic($uid, $sub, $txt) {
            $sql = "INSERT INTO Topic (idUsr, subject, topic) VALUES ('$uid', '$sub', '$txt')";
            if (mysqli_query($this->dbh, $sql)) {
                return $this->dbh->insert_id;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }

        function newComment($uid, $sid, $txt) {
            $sql = "INSERT INTO Comments (idUsr, idTopic, text) VALUES ('$uid', '$sid', '$txt')";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }

        // ------------ MODIFIES ---------------------------------------------------------------
        function promoteUser($id) {
            $sql = "UPDATE Users SET idRole = 7 WHERE idUsr = $id;";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }
        
        // ------------ DELETES ---------------------------------------------------------------
        function denyUser($id, $email) {
            $sql = "DELETE FROM UserReq WHERE idUsrReq = $id";
            if (mysqli_query($this->dbh, $sql)) {
                $to = $email;
                $subject = "Account Request Declined";
                $txt = "We apologize, but your request for an account at aidanlemay.com/TackOverflow has been declined.\n Please revisit the site as a guest to view topics as a guest.\n You can always reply to this email or send a direct email to admin@aidanlemay.com with questions, comments, or concerns.\n Thank you!";
                $headers = "From: admin@aidanlemay.com" . "\r\n";
                mail($to,$subject,$txt,$headers);
                return true;
                return true;
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }

        function deleteUser($id) {
            if ($id == 1) {
                echo "<a href='admin.php'>Not Gonna Happen....</a>";
            }
            else {
                $sql = "DELETE FROM Users WHERE idUsr = $id";
                if (mysqli_query($this->dbh, $sql)) {
                    return true;
                }
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                    return false;
                }
            }
        }

        function deleteTopic($id) {

            $sql = "DELETE FROM Comments WHERE idTopic = $id";
            if (mysqli_query($this->dbh, $sql)) {
            }

            $sql = "DELETE FROM Topic WHERE idTopic = $id";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }

        function deleteComment($id) {
            $sql = "DELETE FROM Comments WHERE idComment = $id";
            if (mysqli_query($this->dbh, $sql)) {
                return true;
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->dbh);
                return false;
            }
        }
   }//end class DB
