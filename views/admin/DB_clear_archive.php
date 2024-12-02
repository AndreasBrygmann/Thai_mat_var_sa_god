<html>
<body>
<?php
    require("DB_connect.php");
    $query = "DELETE FROM Arkiv";
    if (mysqli_query($dbc, $query)) {
        echo "<p>arkiv slettet</p>" ;
        echo "<a href='arkiv_clientside_APP2000.php'>Tilbake til Arkiv</a>";
    }
    else {
        echo "<p>Noe gikk feil</p>" ;
    }
    mysqli_close($dbc);	
?>
</body>
</html>