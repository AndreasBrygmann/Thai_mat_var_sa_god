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
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Oppdater ordrelinjer</title>
</head>

<body>
    <?php
        require('DB_connect.php');
        $ordrenr = $_GET['id'];
        $n = $_POST['n'];
        for ($i=0; $i < $n; $i++) {
            $varenr=trim(strip_tags($_POST["vnr_$i"]));
            $antall=trim(strip_tags($_POST["antall_$i"]));
            $query = "UPDATE Ordrelinje SET Antall='$antall' WHERE Ordrenr='$ordrenr' AND Varenr='$varenr'";
            mysqli_query($dbc, $query);
        }
        if (mysqli_affected_rows($dbc) > 0) {
            echo "<p>Ordre oppdatert!</p>";
            echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til Bestillinger</a>";
        }
        else{
            echo "<p>Noe gikk galt</p><br>";
            echo "Følgende er feilmelding: ".mysqli_error($dbc);
            echo "<br>";
            echo $query;
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