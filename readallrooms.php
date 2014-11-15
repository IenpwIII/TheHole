<!DOCTYPE>
<html>
<head>
    <title>The Hole</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class='content'>
        <?PHP
            require_once "./config.php";
            print "<a href ='index.php'>Go back</a>";

            $connection = mysqli_connect($serv, $user, $pass, $data);

            if ($connection) {
                $query="SELECT * FROM rooms";
                $result=mysqli_query($connection,$query);

                while ( $db_field = mysqli_fetch_assoc($result) ) {
                    print "<div class='room'>\n";
                        print "<ul>\n";
                            foreach ($db_field as $key => $value) {
                                print "<li>$key: ".$value."</li>\n";
                            }
                        print "</ul>\n";
                    print "</div>\n";
                }

                mysqli_close($connection);
            } else {
                print "DATABASE ERROR: Not found";
            }

        ?>
    </div>
</body>
</html>