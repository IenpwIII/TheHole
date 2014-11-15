<?PHP
    session_start();
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
    <div class='content'>
        <p>
            New character: <br />
            <form action='functions/chargen.php' method='post'>
            <input type='text' name='name' value='name' /> <br />
            <input type='submit' name='submit' value='Login' />
            </form>
        </p>
    </div>
</body>
</html>