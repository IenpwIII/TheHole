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

        if (connectDB()){
            $username = mysql_real_escape_string($_POST['username']);
            $password = mysql_real_escape_string($_POST['password']);
            $email = mysql_real_escape_string($_POST['email']);

            $query = "INSERT INTO users( username, password, email ) VALUES ('$username',SHA1('$password'),'$email')";
            $result=mysql_query($query);
            if ($result==false){
                print "There was an error with your registration information.";
            } else {
                print "Success! Welcome, $username! Click <a href='../index.php'>here</a> to go back to the homepage and login.";
            }
            disconnectDB();
        } else {
            print "Error! Could not connect to database D:";
        }
    ?>
</body>
</html>