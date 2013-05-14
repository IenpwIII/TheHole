<?PHP
    $user='hole';
    $pass='1';
    $data='hole';
    $serv='localhost';

    $db_handle = mysql_connect($serv,$user,$pass);
    $db_found = mysql_select_db($data,$db_handle);

    if ($db_found) {

        $to_get=intval($_GET['roomid']);

        if ($_GET['readwrite'] == 'write') {
            $name = $_GET['name'];
            $x_size = intval($_GET['xsize']);
            $y_size = intval($_GET['ysize']);
            $description = $_GET['description'];

            $query="INSERT INTO rooms (name,xsize,ysize,description) VALUES ('$name','$x_size','$y_size','$description')";
            print $query;
            $result=mysql_query($query);
            $query="SELECT * FROM rooms ORDER BY roomid DESC LIMIT 1";
        } else {
            $query="SELECT * FROM rooms WHERE roomid = $to_get";
        }

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