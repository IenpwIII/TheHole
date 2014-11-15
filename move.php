<?PHP
    require_once "$home_folder/functions/connfunc.php";
    require_once "$home_folder/functions/roomfunc.php";

    require_once "$home_folder/functions/printversion.php";
    
    $connection = connectDB();

    if ($connection) {
        // select whichever room they wanted
        $x_loc = intval($_POST['xloc']);
        $y_loc = intval($_POST['yloc']);
        $z_loc = intval($_POST['zloc']);

        $entry = $_POST['journal'];
        $userid = $_SESSION['userid'];

        if (isset($_SESSION["room"])) {
            writeJournal($x_loc,$y_loc,$z_loc,$userid,$_SESSION["room"],$entry,$connection);
        }
        if ($_POST['direction']=="North"){
            $y_loc = $y_loc + 1;
        } elseif ($_POST['direction']=="South"){
            $y_loc = $y_loc - 1;
        } elseif ($_POST['direction']=="East"){
            $x_loc = $x_loc + 1;
        } elseif ($_POST['direction']=="West"){
            $x_loc = $x_loc - 1;
        }
        $_SESSION["room"]=enterRoom($x_loc,$y_loc,$z_loc,$connection);
    } else { // if we can't connect to database
        print "DATABASE ERROR: Not found";
    }
    disconnectDB()
?>