<!DOCTYPE>

<html>
<head>
    <title>The Hole</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?PHP
        require_once "config.php";
        require_once "$home_folder/functions/printversion.php";
    ?>
    <div class='content'>
        <?PHP
            require_once "$home_folder/room.php";
        ?>
    </div>
    <div class='content'>
        <p>
            <?php
                print "<a href='$home_folder/readallrooms.php'>Read all rooms!</a>";
            ?>
        </p>
        <p>
            <form action='index.php' method='post' autocomplete='off'>
                <?PHP
                    print "<input type='hidden' name='xloc' value='$x_loc' />";
                    print "<input type='hidden' name='yloc' value='$y_loc' />";
                    print "<input type='hidden' name='zloc' value='$z_loc' />";
                ?>
                <input type='submit' name='direction' value='North' /> 
                <input type='submit' name='direction' value='South' /> 
                <input type='submit' name='direction' value='East' />
                <input type='submit' name='direction' value='West' />
            </form>
        </p>
    </div>
</body>
</html>