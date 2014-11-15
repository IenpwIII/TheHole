<?PHP
    session_start();
    require "functions/auth.php";
?>
<!DOCTYPE>
<html>
<head>
    <title>The Hole</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?PHP
        require_once "config.php";
        require_once "functions/printversion.php";
        require_once "$home_folder/functions/connfunc.php";
    ?>
    <div class='content'>
        <p>
            <?php 
                $username=$_SESSION['username'];
                print "Welcome, ".$username."! <br />";

                $connection = connectDB();

                if ($connection){
                    // get the name of the player's current character
                    $query="SELECT currchar FROM users WHERE username='$username'";
                    $result=mysqli_query($connection,$query);
                    $currchar=intval(mysqli_fetch_assoc($result));
                    // if not 0, display the name
                    if ($currchar !=0){
                        $query="SELECT name FROM characters WHERE charid='$currchar'";
                        $result=mysqli_query($connection,$query);
                        $name=mysqli_fetch_array($result)[0];
                        print "Current character: ".$name.". Click <a href='teleport.php'>here</a> to continue.";
                    } else {
                        print "You have no current character. Click <a href='new.php'>here</a> to create one.";
                    }
                } else { // if we can't connect to database
                    print "DATABASE ERROR: Not found";
                }
                disconnectDB()
            ?>
        </p>
    </div>
</body>
</html>