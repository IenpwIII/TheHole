<?php
    session_start();

    require_once "../config.php";
    require_once "connfunc.php";

    // gets username and password and logs in

    $connection = connectDB();

    if ($connection){
        $username=mysqli_real_escape_string($connection, $_POST['username']);
        $password=mysqli_real_escape_string($connection, $_POST['password']);


        // gets the number of users that exist with that username and password 
        $query="SELECT userid FROM users WHERE username='$username' and password=SHA1('$password')";
        $result=mysqli_query($connection, $query);
        $count=mysqli_num_rows($result);

        // should be exactly one. If so, send to character select
        if($count==1){
            $userid=mysqli_fetch_assoc($result, 0);
            $_SESSION['userid']=intval($userid);
            $_SESSION['username']=$username;
            header('Location: ../charsel.php');
        // if not, tell them what's up.
        } else {
            print "<html>";
            print "<head>";
            print "    <title>The Hole</title>";
            print "    <link rel='stylesheet' type='text/css' href='style.css'>";
            print "</head>";
            print "<body>";
            print "Wrong Username or Password. <a href='../index.php'>Go back.</a>";
        }
        disconnectDB();
    } else {
        print "<html>";
        print "<head>";
        print "    <title>The Hole</title>";
        print "    <link rel='stylesheet' type='text/css' href='style.css'>";
        print "</head>";
        print "<body>";
        print "Error! Could not connect to database!";
    }
    print "</body>";
    print "</html>";
    ob_end_flush();
?>
