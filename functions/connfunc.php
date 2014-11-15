<?PHP 
    // connects to a database
    function connectDB() {
        global $serv,$user,$pass,$data;
        
        $connection = mysqli_connect($serv, $user, $pass, $data);

        return $connection;
    }
    

    // closes an existing connection
    function disconnectDB() {
        global $serv,$user,$pass,$data;

        mysqli_close(mysqli_connect($serv, $user, $pass, $data));
    }
?>