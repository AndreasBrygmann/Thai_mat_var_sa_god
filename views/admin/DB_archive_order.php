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
    <title>Archiving order...</title>
</head>

<body>
    <?php
        require("DB_connect.php");
        $ordrenr = $_GET['id'];
        $copyquery = "INSERT INTO Arkiv SELECT * FROM Ordre WHERE Ordre.Ordrenr=$ordrenr"; /* This query copies the element from Ordre to Arkiv */
        mysqli_query($dbc, $copyquery);
        /* Once the element has been confirmed copied it is deleted from Ordre */
        if (mysqli_affected_rows($dbc)==1) {
            $delquery = "DELETE FROM Ordre WHERE Ordrenr = $ordrenr";
            mysqli_query($dbc, $delquery);
            if (mysqli_affected_rows($dbc)>0) {
                echo "<p> Ordre arkivert </p>";
                echo "<a href='bestillinger_clientside_APP2000.php'>Tilbake til Bestillinger</a>";
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