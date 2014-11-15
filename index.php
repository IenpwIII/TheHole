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
            Login: <br />
            <form action='functions/login.php' method='post'>
            <input type='text' name='username' value='username' /> <br />
            <input type='password' name='password' value='password' /> <br />
            <input type='submit' name='submit' value='Login' />
            </form>
        </p>
        <p>
            Register: <br />
            <form action='functions/register.php' method='post'>
            <input type='text' name='username' value='username' /> (4-16 characters)<br />
            <input type='text' name='email' value='email@example.com' /> <br />
            <input type='password' name='password' value='password' /> (6-16 characters)<br />
            <input type='submit' name='submit' value='Register' /> <br />
            </form>
        </p>
    </div>
    <a href="credits.php">Credits</a>
</body>
</html>