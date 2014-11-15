<?PHP
    session_start();
    require "auth.php";
?>

<!DOCTYPE>

<html>
<head>
    <title>The Hole</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once "../config.php";
        require_once "connfunc.php";

        // creates a character from given information

        $connection = connectDB();

        if ($connection){
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $userid = $_SESSION['userid'];

            $query = "INSERT INTO characters( name,userid ) VALUES ('$name','$userid')";
            $result=mysqli_query($connection, $query);

            // gets the charid of the character and then
            // changes current character to the new character and appends the new character to the list of all characters
            $query="SELECT charid FROM characters WHERE name='$name'";
            $result=mysqli_query($connection, $query);
            $currchar=intval(mysqli_fetch_assoc($result,0));
            $query = "UPDATE users WHERE userid = '$userid' SET currchar = $currchar";
            $result=mysqli_query($connection, $query)
            $query = "UPDATE users WHERE userid = '$userid' SET characters = CONCAT(characters,'$currchar,')";
            $result=mysqli_query($connection, $query)

            if ($result==false){
                print "There was an error with your registration information.";
            } else {
                print "Success! Welcome, $name! Click <a href='../teleport.php'>here</a> to continue";
            }
            disconnectDB();

        } else {
            print "Error! Could not connect to database D:";
        }
        print "<br />Click <a href='../index.php'>here</a> to go back.";
    ?>
</body>
</html>