<?PHP
    print "<form action='room.php' method='post' autocomplete='off'>";
    print "    x: <input type='text' name='xloc' /> ";
    print "    y: <input type='text' name='yloc' /> ";
    print "    z: <input type='text' name='zloc' />";
    print "    z: <input type='text' name='journal' value = 'Someone teleported here' />";
    print "    <input type='hidden' name='direction' value='custom' />";
    print "    <input type='submit' name='submit'/> <br />";
    print "</form>";
?>