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
    <link rel="stylesheet" href="../../src/css/adminPages.css">
    <title>Endre inventar</title>
</head>

<body>

    <nav class="navbar">
        <a href="bestillinger_clientside_APP2000.php"><br>Bestillinger</a>
        <a href="arkiv_clientside_APP2000.php"><br>Arkiv</a>
        <a href="inventar_clientside_APP2000.php"><br>Inventar</a>
        <a href="sales.php"><br>Salgstatistikk</a>
    </nav>

    <div class="container">

        <div class="header">
            <a href="logout.php">
                <div class="btn">Logg ut</div>
            </a>
        </div>

        <h2>Endre vare</h2>
        <?php
        $varenr=$_GET['id'];
        require('DB_connect.php');
        $viewquery = "SELECT * FROM Inventar WHERE Varenr = $varenr";
        if ($r = mysqli_query($dbc, $viewquery)) {
            if (mysqli_affected_rows($dbc)==0) {
                echo "<p>Ingen vare funnet</p>";
            }
            else {
                while ($row=mysqli_fetch_array($r)) {
                    $varenr=$row['Varenr'];
                    $varenavn=$row["Navn"];
                    $enhet=$row["Enhet"];
                    $antall=$row["Antall"];
                    $pris=$row["Pris"];
                }
            }
        }

    ?>
        <form action="DB_update_inv2.php" method="POST">
            <p>Varenr <input type="text" name="varenr" value="<?php echo $varenr; ?>" readonly></p>
            <p>Varenavn <input type="text" name="varenavn" size="20" value="<?php echo $varenavn; ?>"></p>
            <p>Enhet <input type="text" name="enhet" size="20" value="<?php echo $enhet; ?>"></p>
            <p>Antall <input type="text" name="antall" size="20" value="<?php echo $antall; ?>"></p>
            <p>Pris <input type="text" name="pris" size="20" value="<?php echo $pris; ?>"></p>
            <input type="submit" name="submit" value="Endre inventar">
        </form>

    </div>
</body>

</html>

<?php
}
else{
  header("Location: ../../login_index.php?");
  exit();
}
?>