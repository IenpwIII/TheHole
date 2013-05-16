<?PHP
    $serv='localhost';
    $user='hole';
    $pass='1';
    $data='hole';
    $home_folder = "C:/wamp/www/hole";
    $data_folder = "$home_folder/data";
    $map_file = "$data_folder/map/map.txt";

    require_once "connfunc.php";
    require_once "roomfunc.php";

    require_once "printversion.php";
    print "<a href ='index.php'>Go back</a><br />";

    if (connectDB()) {
        // select whichever room they wanted by parsing the coordinate file
        $x_loc = intval($_POST['xloc']);
        $y_loc = intval($_POST['yloc']);
        $z_loc = intval($_POST['zloc']);
        enterRoom($x_loc,$y_loc,$z_loc);
    } else { // if we can't connect to database
        print "DATABASE ERROR: Not found";
    }
    disconnectDB()
?>