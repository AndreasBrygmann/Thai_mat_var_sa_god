<?php
session_start([
  //Cookie valied only for 1 day or till closed
  'cookie_lifetime' => 86400,
  'read_and_close' => true,
]);

if(isset($_SESSION['id']) && isset($_SESSION['username'])){

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gjør endringer</title>
</head>

<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            /* Checks that a valid ordernr has been entered */
            if(!empty($_POST['ordrenr'])) {
                $ordrenr = trim(strip_tags($_POST['ordrenr']));
                require("DB_connect.php");
                $viewquery = "SELECT * FROM Ordre WHERE Ordrenr = $ordrenr";
                /* Checks that the order exists */
                if ($r = mysqli_query($dbc, $viewquery)) {
                    if (mysqli_affected_rows($dbc)==0) {
                        echo "<p> Bestilling ikke funnet </p>";
                    }
                    else {
                        /* Updates the order */
                        if (isset($_POST['endre'])) {
                            $ordrenr = trim(strip_tags($_POST['ordrenr']));
                            $datotid=trim(strip_tags($_POST['datotid']));
                            $kundenavn=trim(strip_tags($_POST['kundenavn']));
                            $epost=trim(strip_tags($_POST['epost']));
                            $adresse=trim(strip_tags($_POST['adresse']));
                            $telefon=trim(strip_tags($_POST['telefon']));
                            $kommentar=trim(strip_tags($_POST['kommentar']));
                            $updateQuery = "UPDATE `Ordre` SET `DatoTid` = '$datotid', `Navn` = '$kundenavn', `E-post` = '$epost', `Adresse` = '$adresse', `Telefon` = '$telefon', `Kommentar` = '$kommentar' WHERE `Ordre`.`Ordrenr` = '$ordrenr' ";
                            mysqli_query($dbc, $updateQuery);
                            if (mysqli_affected_rows($dbc)==1) {
                                echo "<p>Ordre oppdatert!</p>";
                                echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til Bestillinger</a>";
                            }
                            else{
                                echo "<p>Noe gikk galt</p>";
                            }					
                        }
                        if (isset($_POST['slett'])) {
                            header("Location:DB_delete_order.php?id=".$ordrenr);
                    }
                    
                }
                
            }
            mysqli_close($dbc);
        }
        else {
            echo "<p style="."color:red".">Skriv inn et ordrenr.<br></p>";					
        }
    }
    ?>
</body>

</html>

<?php
}
else{
  header("Location: ../../login_index.php?");
  exit();
}
?>