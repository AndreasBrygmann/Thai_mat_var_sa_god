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
    <title>Document</title>
</head>

<body>
    <?php
        require("DB_connect.php");
        $ordrenr = $_GET['id'];
        /* Orders are deleted from 2 tables: Ordre and Ordrelinje */
        $query = "DELETE FROM Ordre WHERE Ordrenr = $ordrenr";
        $query2 = "DELETE FROM Ordrelinje WHERE Ordrenr = $ordrenr";
        mysqli_query($dbc, $query2);
        mysqli_query($dbc, $query);
        if (mysqli_affected_rows($dbc)==1) {
            echo "<p>Ordre slettet</p>" ;
            echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til Bestillinger</a>";
        }
        else {
            echo "<p>Noe gikk feil</p>" ;
            /* echo "<p>Ordre slettet</p>" ;
            echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til Bestillinger</a>"; */
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