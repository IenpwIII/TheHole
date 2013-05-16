<?PHP
    print "<form action='index.php' method='post' autocomplete='off'>";
    print "    x: <input type='text' name='xloc' /> ";
    print "    y: <input type='text' name='yloc' /> ";
    print "    z: <input type='text' name='zloc' />";
    print "    <input type='hidden' name='direction' value='custom' />";
    print "    <input type='submit' name='submit'/> <br />";
    print "</form>";
?>