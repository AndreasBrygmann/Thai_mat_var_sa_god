<?php
/* session_start([
  //Cookie valied only for 1 day or till closed
  'cookie_lifetime' => 86400,
  'read_and_close' => true,
]); */
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
        $ordrenr = $_GET['o'];
        $varenr = $_GET['i'];
        $query = "DELETE FROM Ordrelinje WHERE Ordrenr = $ordrenr AND Varenr = $varenr";
        mysqli_query($dbc, $query);
        if (mysqli_affected_rows($dbc)==1) {
            echo "<p>Ordrelinje slettet</p>" ;
            echo '<a href="order_details.php?id='.$ordrenr.'">Tilbake til Ordredetaljer</a>';
        }
        else {
            echo "<p>Noe gikk feil</p>" ;
        }
        mysqli_close($dbc);	
    ?>
</body>

</html>

<?php
/* else{
  header("Location: ../../login_index.php?");
  exit();
} */
?>