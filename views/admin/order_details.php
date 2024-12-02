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
    <title>Bestillingsdetaljer</title>

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

        <div>

            <h1>Bestillingsdetaljer</h1>
            <!-- fetches and displays the details of an order -->
            <?php
        $ordrenr=$_GET['id'];
        require('DB_connect.php');
        $viewquery = "SELECT * FROM Ordre WHERE Ordrenr = $ordrenr";
        if ($r = mysqli_query($dbc, $viewquery)) {
            if (mysqli_affected_rows($dbc)==0) {
                echo "<p>Ingen ordre funnet</p>";
            }
            else {
                while ($row=mysqli_fetch_array($r)) {
                    $ordrenr=$row['Ordrenr'];
                    $datotid=$row["DatoTid"];
                    $kundenavn=$row["Navn"];
                    $epost=$row["E-post"];
                    $adresse=$row["Adresse"];
                    $telefon=$row["Telefon"];
                    $kommentar=$row["Kommentar"];
                }
            }
        }

    ?>
            <form action="update_delete_order.php" method="POST">
                <p>ordrenr <input type="text" name="ordrenr" value="<?php echo $ordrenr; ?>" readonly></p>
                <p>dato og tid <input type="text" name="datotid" size="20" value="<?php echo $datotid; ?>"></p>
                <p>kundenavn <input type="text" name="kundenavn" size="20" value="<?php echo $kundenavn; ?>"></p>
                <p>epost <input type="text" name="epost" size="20" value="<?php echo $epost; ?>"></p>
                <p>adresse <input type="text" name="adresse" size="20" value="<?php echo $adresse; ?>"></p>
                <p>telefon <input type="text" name="telefon" size="20" value="<?php echo $telefon; ?>"></p>
                <p>kommentar <input type="text" name="kommentar" size="20" value="<?php echo $kommentar; ?>"></p>
                <input type="submit" name="endre" value="Lagre">
                <input type="submit" name="slett" value="Slett ordre">
            </form>
            <!-- The following code is for displaying the orderlines of the order -->
            <table class="table">
                <form action="DB_update_orderline.php?id=<?php echo $ordrenr; ?>" method="POST">
                    <tr>
                        <th>Varenr</th>
                        <th>Varenavn</th>
                        <th>Pris</th>
                        <th>Antall</th>
                    </tr>
                    <?php
                $ordrenr=$_GET['id'];
                require('DB_connect.php');
                $query = "SELECT * FROM Ordrelinje WHERE Ordrenr = $ordrenr";
                $ordrelinjer = $dbc->query($query);
                if ($ordrelinjer->num_rows != 0) {
                    while ($row = $ordrelinjer->fetch_assoc()) {
                        $antall[$row["Varenr"]] = $row["Antall"]; /* Creates an associative array for the elements in the antall(quantity) column */
                        /* echo '<tr>';
                        echo '<td>' .$row["Varenr"]. '</td>';
                        echo '<td>' .$row["Antall"]. '</td>';
                        echo '</tr>'; */
                    }
                    /* Creates associative array for the name(varenavn) and price(pris) columns */
                    foreach($antall as $inr => $val) {
                        $iquery = "SELECT * FROM Inventar WHERE Varenr = $inr";
                        $irow = mysqli_query($dbc, $iquery);
                        $result = mysqli_fetch_assoc($irow);
                        $varenavn[$inr] = $result["Navn"];
                        $pris[$inr] = $result["Pris"];
                    }
                    /* uses the associative arrays to create table entries, as well as a button for deleting the entry */
                    $array = array($varenavn, $pris, $antall);
                    $n = 0;
                    foreach ($varenavn as $key => $value) {
                        echo '<input type="hidden" name="vnr_'.$n.'" value="'.$key.'">';
                        echo '<tr>';
                        echo '<td>' .$key. '</td>';
                        echo '<td>' .$varenavn[$key]. '</td>';
                        echo '<td>' .$pris[$key]. '</td>';
                        echo '<td><input type="number" name="antall_'.$n.'" min="1" value="'.$antall[$key].'" onchange="quantityChanged()"></td>';
                        /* echo '<td>' .$antall[$key]. '</td>'; */
                        /* echo '<td class='.$key.' hidden><a href="...php?o='.$ordrenr.'&i='.$key.'"><button>Oppdater</button></a></td>'; */
                        /* echo '<td><input id="updateButton'.$key.'" type="hidden" value="Oppdater"></td>'; */
                        echo '<td><a href="DB_delete_orderline.php?o='.$ordrenr.'&i='.$key.'"><button>Slett</button></a></td>';
                        echo '</tr>';
                        $n += 1;
                    }
                    echo '<input name="n" type="hidden" value="'.$n.'">';
                }
                else {
                    echo '<tr><td> [Ingen varelinjer] </td></tr>';
                }
            ?>
                    <tr>
                        <td><input id="updateButton" type="hidden" value="Oppdater"></td>
                    </tr>
                </form>
            </table>
            <script>
            function quantityChanged() {
                var b = document.getElementById("updateButton");
                b.type = "submit";
            }
            </script>
        </div>

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