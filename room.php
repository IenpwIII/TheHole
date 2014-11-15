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
    ?>
    <?PHP
        require_once "move.php";
    ?>
    <div class='content'>
        <p>
            <form action='room.php' method='post' autocomplete='off'>
                <?PHP
                    $roomid = $_SESSION['room'];
                    print "<input type='hidden' name='xloc' value='$x_loc' />";
                    print "<input type='hidden' name='yloc' value='$y_loc' />";
                    print "<input type='hidden' name='zloc' value='$z_loc' />";
                    print "<input type='hidden' name='roomid' value='$roomid'/>";
                ?>
                <textarea name='journal' cols="50" rows="15">Write your journal entry here</textarea><br>
                <input type='submit' name='direction' value='North' /> 
                <input type='submit' name='direction' value='South' /> 
                <input type='submit' name='direction' value='East' />
                <input type='submit' name='direction' value='West' />
            </form>
        </p>
        <p>
            <?php
                print "<a href='readallrooms.php'>Read all rooms!</a> <br />";
                $username=$_SESSION['username'];
                print "<a href='functions/logout.php'>Logout as $username</a>";
            ?>
        </p>
    </div>
</body>
</html>