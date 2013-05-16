<?php
    session_start();
    ob_start("loginbuffer");
    print "<html>";
    print "<head>";
    print "    <title>The Hole</title>";
    print "    <link rel='stylesheet' type='text/css' href='style.css'>";
    print "</head>";
    print "<body>";

    require_once "../config.php";
    require_once "connfunc.php";
    
    if (connectDB()){
        $username=mysql_real_escape_string($_POST['username']);
        $password=mysql_real_escape_string($_POST['password']);
         
        $query="SELECT userid FROM users WHERE username='$username' and password=SHA1('$password')";
        $result=mysql_query($query);
        $count=mysql_num_rows($result);
        $userid=mysql_result($result, 0);

        if($count==1){
          $_SESSION['userid']=intval($userid);
          $_SESSION['username']=$username;
          header('Location: ../teleport.php');
        } else {
          echo "Wrong Username or Password";
        }
        disconnectDB();
    } else {
        print "Error! Could not connect to database!";
    }
    print "</body>";
    print "</html>";
    ob_end_flush();
?>
