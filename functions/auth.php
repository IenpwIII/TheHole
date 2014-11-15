<?PHP
    //include this file at the top of any pages to be viewed only by logged-in users
    if (! isset($_SESSION['userid'])) {
        header("location: index.php");
    }
?>