<?PHP 
    function connectDB() {
        global $serv,$user,$pass,$data;
        
        $db_handle = mysql_connect($serv,$user,$pass);
        $db_found = mysql_select_db($data,$db_handle);

        return $db_found;
    }
    

    function disconnectDB() {
        global $serv,$user,$pass,$data;

        mysql_close(mysql_connect($serv,$user,$pass));
    }
?>