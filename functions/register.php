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

        $connection = connectDB();

        if ($connection){
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);

            // check username/password length/email validity

            if (strlen($username) > 16 || strlen($username) < 4 || strlen($password) > 16 || strlen($password) < 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                print "There was an error with your registration information.";
            } else {
                // make sure username/email are unique
                $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
                if(mysqli_num_rows($query) != 0)
                {
                    print "That username already exists.";
                } else {   
                    $query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
                    if(mysqli_num_rows($query) != 0){
                        print "That email address already exists.";
                    } else {
                        // if everything is good, create user. otherwise, give them an error.
                        $query = "INSERT INTO users( username, password, email ) VALUES ('$username',SHA1('$password'),'$email')";
                        $result=mysqli_query($connection, $query);
                        if ($result==false){
                            print "There was an error with your registration information.";
                        } else {
                            print "Success! Welcome, $username!";
                        }
                        disconnectDB();   
                    }
                }
            }
        } else {
            print "Error! Could not connect to database D:";
        }
        print "<br />Click <a href='../index.php'>here</a> to go back to the homepage.";
    ?>
</body>
</html>