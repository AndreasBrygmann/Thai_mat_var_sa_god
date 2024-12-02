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
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $varenr=trim(strip_tags($_POST['varenr']));
                $navn=trim(strip_tags($_POST['navn']));
                $enhet=trim(strip_tags($_POST['enhet']));
                $antall=trim(strip_tags($_POST['antall']));
                $pris=trim(strip_tags($_POST['pris']));

            require('DB_connect.php');
            $query = "INSERT INTO Inventar (`Varenr`, `Navn`, `Enhet`, `Antall`, `Pris`) VALUES ('$varenr', '$navn', '$enhet', $antall, $pris)";
            if (mysqli_query($dbc, $query)){
                echo "<h3>Inventar lagret!</h3>";
                echo "<a href='inventar_clientside_APP2000.php'>Tilbake til Inventar side</a>";				
                }
                else{
                    echo "<p style="."color:red".">Kunne ikke lagre varen fordi:<br>".
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