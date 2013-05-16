<?PHP
    require_once "$home_folder/functions/connfunc.php";
    require_once "$home_folder/functions/roomfunc.php";

    require_once "$home_folder/functions/printversion.php";
    print "<a href ='index.php'>Go back</a><br />";

    if (connectDB()) {
        // select whichever room they wanted
        $x_loc = intval($_POST['xloc']);
        $y_loc = intval($_POST['yloc']);
        $z_loc = intval($_POST['zloc']);
        if ($_POST['direction']=="North"){
            $y_loc = $y_loc + 1;
        } elseif ($_POST['direction']=="South"){
            $y_loc = $y_loc - 1;
        } elseif ($_POST['direction']=="East"){
            $x_loc = $x_loc + 1;
        } elseif ($_POST['direction']=="West"){
            $x_loc = $x_loc - 1;
        } 
        enterRoom($x_loc,$y_loc,$z_loc);
    } else { // if we can't connect to database
        print "DATABASE ERROR: Not found";
    }
    disconnectDB()
?>