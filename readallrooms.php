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

            $db_handle = mysql_connect($serv,$user,$pass);
            $db_found = mysql_select_db($data,$db_handle);

            if ($db_found) {
                $query="SELECT * FROM rooms";
                $result=mysql_query($query);

                while ( $db_field = mysql_fetch_assoc($result) ) {
                    print "<div class='room'>\n";
                        print "<ul>\n";
                            foreach ($db_field as $key => $value) {
                                print "<li>$key: ".$value."</li>\n";
                            }
                        print "</ul>\n";
                    print "</div>\n";
                }

                mysql_close($db_handle);
            } else {
                print "DATABASE ERROR: Not found";
            }

        ?>
    </div>
</body>
</html>