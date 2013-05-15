<?PHP
    $user='hole';
    $pass='1';
    $data='hole';
    $serv='localhost';

    // connect to mysql
    $db_handle = mysql_connect($serv,$user,$pass);
    $db_found = mysql_select_db($data,$db_handle);

    // if connected
    if ($db_found) {

        // also figure out whether we're reading or writing
        if ($_GET['readwrite'] == 'write') {
            // figure out what the new entry should be and make it, then select which room to retrieve (the one we just made)
            $name = $_GET['name'];
            $x_size = intval($_GET['xsize']);
            $y_size = intval($_GET['ysize']);
            $x_pos = intval($_GET['xpos']);
            $y_pos = intval($_GET['ypos']);
            $z_pos = intval($_GET['zpos']);
            $description = $_GET['description'];

            $query="INSERT INTO rooms (name,xsize,ysize,description) VALUES ('$name','$x_size','$y_size','$description')";
            $result=mysql_query($query);

            $query="SELECT * FROM rooms ORDER BY roomid DESC LIMIT 1";

            // also write the coordinates and roomid to the map file
            $new_id=mysql_result(mysql_query("SELECT roomid FROM rooms ORDER BY roomid DESC LIMIT 1"),0);
            $map_file = "data/map/map.txt";
            $fh = fopen($map_file, 'a') or die("can't open file");
            $stringData = "$x_pos,$y_pos,$z_pos:$new_id\n";
            fwrite($fh, $stringData);
            fclose($fh);
        // otherwise, select whichever room they wanted by parsing the coordinate file. VERY BAD TO ENTER NON-EXISTENT COORDINATES SO FAR
        } else {
            $map_file = "data/map/map.txt";
            $locations = file_get_contents($map_file);
            $x_loc = intval($_GET['xloc']);
            $y_loc = intval($_GET['yloc']);
            $z_loc = intval($_GET['zloc']);
            $search_string = $x_loc.','.$y_loc.','.$z_loc.':';
            $exploded=explode($search_string, $locations);
            $to_get = strstr($exploded[1],"\n",true);
            var_dump($locations);
            var_dump($search_string);
            var_dump($exploded[1]);
            var_dump($to_get);

            $query="SELECT * FROM rooms WHERE roomid = $to_get";
        }

        // print out the value of each field of whichever room and close
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