<?php
session_start([
  //Cookie valied only for 1 day or till closed
  'cookie_lifetime' => 86400,
  'read_and_close' => true,
]);

if(isset($_SESSION['id']) && isset($_SESSION['username'])){

 ?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../src/css/adminPages.css">
    <title>Inventar</title>
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

        <h1>Inventar</h1>

        <table>
            <tr>
                <th class="number">Varenr</th>
                <th class="name">Navn</th>
                <th class="number">Enhet</th>
                <th class="number">Antall</th>
                <th class="price">Pris</th>
            </tr>

            <!--php for database-->
            <?php
                require('DB_connect.php');
                $query= "SELECT * FROM Inventar";
                $inv_list = $dbc->query($query);
                if ($inv_list->num_rows != 0) {
                    $n=0;
                    $vnrlist = array();
                    while ($row = $inv_list->fetch_assoc()) {
                        $vnrlist[] = $row["Varenr"]; /* Legger varenummeret inn i array */
                        echo '<tr>';
                        echo '<td>' .$row["Varenr"]. '</td>';
                        echo '<td>' .$row["Navn"]. '</td>';
                        echo '<td>' .$row["Enhet"]. '</td>';
                        echo '<td>' .$row["Antall"]. '</td>';
                        echo '<td>' .$row["Pris"]. '</td>'; /* Henter varenummret og legger inn i url som blir sendt videre */
                        echo '<td> <a href = "DB_update_inv.php?id='.$vnrlist[$n].'"style = "text-decoration: none; color: black;"><button class="btn"">Endre</button></a></td>';
                        echo '<td> <a href = "DB_delete_inv.php?id='.$vnrlist[$n].'"style = "text-decoration: none; color: black;"><button class="btn"">Slett</button></a></td>';
                        echo '</tr>';
                        $n += 1;
                    }
                } else {
                echo 'inventory empty';}
            ?>

            <form action="DB_insert_inventory.php" method="POST">
                <tr>
                    <td><input type="text" name="varenr" class="input-field" placeholder="Legg til ny vare..." required>
                    </td>
                    <td><input type="text" name="navn" class="input-field" required></td>
                    <td><input type="text" name="enhet" class="input-field" required></td>
                    <td><input type="text" name="antall" class="input-field" required></td>
                    <td><input type="text" name="pris" class="input-field" required>
                    <td><input type="submit" value="Lagre" class="btn"></td>
                    </td>
                </tr>
            </form>
        </table>

        <div class="footer">
            <a href="update_delete_inv.php">
                <div class="btn">Søk på varenr</div>
            </a>
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