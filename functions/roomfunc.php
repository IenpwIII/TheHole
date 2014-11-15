<?PHP
    // crate a room in the database given the required information.
    function createRoom($name,$x_pos,$y_pos,$z_pos,$x_size,$y_size,$description,$connection) {
        $name = mysqli_real_escape_string($connection, $name);
        $x_pos = mysqli_real_escape_string($connection, $x_pos);
        $y_pos = mysqli_real_escape_string($connection, $y_pos);
        $z_pos = mysqli_real_escape_string($connection, $z_pos);
        $x_size = mysqli_real_escape_string($connection, $x_size);
        $y_size = mysqli_real_escape_string($connection, $y_size);
        $description = mysqli_real_escape_string($connection, $description);

        $query= "INSERT INTO rooms( name, xloc, yloc, zloc, xsize, ysize, description ) VALUES ('$name',$x_pos,$y_pos,$z_pos,$x_size,$y_size,'$description')";
        $result=mysqli_query($connection,$query);
    }

    // generate a brand new room
    function genRoom($x_pos,$y_pos,$z_pos,$connection) {
        // room size hasn't been implemented yet
        $x_size = 1;
        $y_size = 1;
        // randomly generated names and descriptions haven't been implemented yet
        $rum = rand(1,10000);
        $name = "Storage closet #$rum";
        $description = "An empty storage closet";
        createRoom($name,$x_pos,$y_pos,$z_pos,$x_size,$y_size,$description,$connection);
        printRoom($x_pos,$y_pos,$z_pos,$connection);
    }

    // called when user enters room
    function enterRoom($x_pos,$y_pos,$z_pos,$connection) {
        $x_pos = mysqli_real_escape_string($connection, $x_pos);
        $y_pos = mysqli_real_escape_string($connection, $y_pos);
        $z_pos = mysqli_real_escape_string($connection, $z_pos);

        $query="SELECT * FROM `rooms` WHERE xloc=$x_pos AND yloc=$y_pos AND zloc=$z_pos";
        $result=mysqli_query($connection,$query);
        // if the room exists, print relevant info. If not, generate it.
        if (mysqli_fetch_array($result)) {
            $table = findRoom($x_pos,$y_pos,$z_pos,$connection);
            $fields = mysqli_fetch_assoc($table);
            $name = $fields['name'];
            $desc = $fields['description'];
            $roomid = $fields['roomid'];
            print "You enter <strong>$name</strong>.";
            print "<div class='desc'> $desc </div>";
        } else {
            genRoom($x_pos,$y_pos,$z_pos,$connection);
            $roomid = enterRoom($x_pos,$y_pos,$z_pos,$connection);
        }
        return $roomid;
    }

    // saves the journal entry
    function writeJournal($x_pos,$y_pos,$z_pos,$userid,$roomid,$entry,$connection) {
        // creates entry
        $content = mysqli_real_escape_string($connection,$entry);
        $query = "INSERT INTO entries(author,room,content) VALUES ('$userid','$roomid','$content')";
        $result=mysqli_query($connection,$query);

        // writes to room
        $query = "SELECT entryid FROM entries WHERE (author = '$userid' and content = '$content' and room = '$roomid')";
        $result=mysqli_query($connection,$query);
        $entryid=intval(mysqli_fetch_assoc($result));

        $query="UPDATE rooms where roomid = $roomid SET entries = CONCAT(entries,'$entryid,')";
        $result=mysqli_query($connection,$query);

        // and to character
        $query="UPDATE characters where userid = $userid SET entries = CONCAT(entries,'$entryid,')";
        $result=mysqli_query($connection,$query);
    }

    // given a coordinate set, find the room at that location
    function findRoom($x_pos,$y_pos,$z_pos,$connection) {
        $x_pos = mysqli_real_escape_string($connection,$x_pos);
        $y_pos = mysqli_real_escape_string($connection,$y_pos);
        $z_pos = mysqli_real_escape_string($connection,$z_pos);
        
        $query="SELECT * FROM `rooms` WHERE xloc=$x_pos AND yloc=$y_pos AND zloc=$z_pos";
        $result=mysqli_query($connection,$query);
        return $result;
    }


    // print a bunch of info about a room
    function printRoom($x_pos,$y_pos,$z_pos,$connection) {
        $table = findRoom($x_pos,$y_pos,$z_pos,$connection);
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
        while ( $db_field = mysqli_fetch_assoc($table) ) {
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