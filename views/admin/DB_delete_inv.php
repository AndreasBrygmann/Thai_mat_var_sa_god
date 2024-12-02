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
    <title>Slett invetar</title>
</head>

<body>
    <?php
        require("DB_connect.php");
        $varenr = $_GET['id'];
        $query = "DELETE FROM Inventar WHERE Varenr = $varenr";
        mysqli_query($dbc, $query);
        if (mysqli_affected_rows($dbc)==1) {
            echo "<p>Vare slettet</p>" ;
            echo "<a href='inventar_clientside_APP2000.php'>Tilbake til Inventar side</a>";
        }
        else {
            echo "<p>Noe gikk feil</p>" ;
        }
        mysqli_close($dbc);	
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