<!DOCTYPE>

<?php
if (isset($_COOKIE["user"])) {
    echo "Welcome " . $_COOKIE["user"] . "!<br>";
} else {
    $expire=time()+60*60*24*30;
    setcookie("user", "developer", $expire);
    // session_start();
}
?>

<html>
<head>
    <title>The Hole</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?PHP
        require_once "printversion.php";
    ?>
    <div class='content'>
        <p><a href="readallrooms.php">Read all rooms!</a>
        <p>
            <form action='index.php' method='post' autocomplete='off'>
                x: <input type='text' name='xloc' /> 
                y: <input type='text' name='yloc' /> 
                z: <input type='text' name='zloc' />
                <input type='submit' name='submit'/> <br />
            </form>
        </p>
    </div>
    <div class='content'>
        <?PHP
            require_once "room.php";
        ?>
    </div>
</body>
</html>