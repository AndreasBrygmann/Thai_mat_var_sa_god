<?php
session_start([
  //Cookie valied only for 1 day or till closed
  'cookie_lifetime' => 86400,
  'read_and_close' => true,
]);

if(isset($_SESSION['id']) && isset($_SESSION['username'])){

 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Lagre inventar</title>
</head>

<body>
    <?php
            require('DB_connect.php');
            /* $vareliste = json_decode($_GET["id"], true); */
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $ordrenr=trim(strip_tags($_POST['ordrenr']));
                $datotid=date("Y-m-d H:i:s");
                $kundenavn=trim(strip_tags($_POST['kundenavn']));
                $epost=trim(strip_tags($_POST['epost']));
                $adresse=trim(strip_tags($_POST['adresse']));
                $telefon=trim(strip_tags($_POST['telefon']));
                $kommentar=trim(strip_tags($_POST['kommentar']));
                $n=trim(strip_tags($_POST['ordercount']));
                for ($i=0; $i < $n; $i++) { 
                    $varenr=trim(strip_tags($_POST["varenr_$i"]));
                    $antall=trim(strip_tags($_POST["antall_$i"]));
                    $rowquery = "INSERT INTO Ordrelinje (`Ordrenr`, `Varenr`, `Antall`) VALUES ('$ordrenr', '$varenr', '$antall')";
                    mysqli_query($dbc, $rowquery);
                }


            $orderquery = "INSERT INTO Ordre (`Ordrenr`, `DatoTid`, `Navn`, `E-post`, `adresse`, `Telefon`, `Kommentar`) VALUES ('$ordrenr', '$datotid', '$kundenavn', '$epost', '$adresse', '$telefon', '$kommentar')";
            if (mysqli_query($dbc, $orderquery)){
                echo "<h3>Ordre lagret!</h3>";
                echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til bestillinger</a>";				
                }
                else{
                    echo "<p style="."color:red".">Kunne ikke lagre ordren fordi:<br>".
                    mysqli_error($dbc).". 
                    </p><p>The query being run was: ".$query."</p>";
                }
                mysqli_close($dbc);

            }
            else {
                echo 'Something went wrong';
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