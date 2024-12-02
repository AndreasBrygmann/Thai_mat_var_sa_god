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
    <link rel="stylesheet" href="../../src/css/adminPages.css">
    <title>Endre eller slette vare</title>
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

        <h2>Endre eller slette vare</h2>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!empty($_POST['varenr'])) {
                $varenr = trim(strip_tags($_POST['varenr']));
                require("DB_connect.php");
                $viewquery = "SELECT * FROM Inventar WHERE Varenr = $varenr";
                if ($r = mysqli_query($dbc, $viewquery)) {
                    if (mysqli_affected_rows($dbc)==0) {
                        echo "<p> Ingen varer med dette varenummeret funnet </p>";
                    }
                    else {
                        if (isset($_POST['update'])) {
                            header("Location:DB_update_inv.php?id=".$varenr);
                        }
                        if (isset($_POST['delete'])) {
                            header("Location:DB_delete_inv.php?id=".$varenr);
                    }
                    
                }
                
            }
            mysqli_close($dbc);
        }
        else {
            echo "<p style="."color:red".">Skriv inn et varenr.<br></p>";					
        }
    }
    ?>
        <form action="update_delete_inv.php" method="POST">
            <p>Skriv inn varenr <input type="text" name="varenr" size="10"></p>
            <input type="submit" name="update" value="Endre vare">
            <input type="submit" name="delete" value="Slett vare">
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