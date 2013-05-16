<?PHP
    function createRoom($name,$x_pos,$y_pos,$z_pos,$x_size,$y_size,$description) {
        $query= "INSERT INTO rooms( name, xloc, yloc, zloc,description ) VALUES ('$name',$x_pos,$y_pos,$z_pos,'$description')";
        $result=mysql_query($query);
    }

    function genRoom($x_pos,$y_pos,$z_pos) {
        // room size hasn't been implemented yet
        $x_size = 1;
        $y_size = 1;
        // randomly generated names and descriptions haven't been implemented yet
        $rum = rand(1,10000);
        $name = "Storage closet #$rum";
        $description = "An empty storage closet";
        createRoom($name,$x_pos,$y_pos,$z_pos,$x_size,$y_size,$description);
        printRoom($x_pos,$y_pos,$z_pos);
    }

    function enterRoom($x_pos,$y_pos,$z_pos) {
        $query="SELECT * FROM `rooms` WHERE xloc=$x_pos AND yloc=$y_pos AND zloc=$z_pos";
        $result=mysql_query($query);
        $check = $result;
        if (mysql_fetch_assoc($check)) {
            print "You enter the room.";
            printRoom($x_pos,$y_pos,$z_pos);
        } else {
            print "R404 <br />";
            genRoom($x_pos,$y_pos,$z_pos);
        }
    }

    function findRoom($x_pos,$y_pos,$z_pos) {
        $query="SELECT * FROM `rooms` WHERE xloc=$x_pos AND yloc=$y_pos AND zloc=$z_pos";
        $result=mysql_query($query);
        return $result;
    }


    function printRoom($x_pos,$y_pos,$z_pos) {
        $table = findRoom($x_pos,$y_pos,$z_pos);
        $fieldalias = array ("roomid" => "Room number",
                             "name" => "Room name",
                             "xloc" => "X position",
                             "yloc" => "Y position",
                             "zloc" => "Z position",
                             "gendate" => "First discovered",
                             "xsize" => "Width",
                             "ysize" => "Length",
                             "description" => "Description",
                             "exits" => "Doors",
                             "entries" => "Journal entries"
                            );
        while ( $db_field = mysql_fetch_assoc($table) ) {
            print "<div class='room'>\n";
                print "<ul>\n";
                    foreach ($db_field as $key => $value) {
                        print "<li>$fieldalias[$key]: ".$value."</li>\n";
                    }
                print "</ul>\n";
            print "</div>\n";
        }
    }
?>