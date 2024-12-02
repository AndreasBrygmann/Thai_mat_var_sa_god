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
    <title>Salgstatistikk</title>
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

        <h1>Salgstatistikk</h1>

        <table>
            <tr>
                <th class="number">Varenr</th>
                <th class="name">Navn</th>
                <th class="number">Totalt antall solgt</th>
            </tr>
            <?php
                require('DB_connect.php');
                $query = "SELECT Varenr, SUM(Antall) AS totalAntall FROM `Ordrelinje`GROUP BY Varenr ORDER BY totalAntall DESC";
                $salgslinjer = $dbc->query($query);
                if ($salgslinjer->num_rows != 0) {
                    while ($row = $salgslinjer->fetch_assoc()) {
                        $antall[$row["Varenr"]] = $row["totalAntall"]; /* Creates an associative array for the elements in the antall(quantity) column */
                    }
                    /* Creates associative array for the name(varenavn) and price(pris) columns */
                    foreach($antall as $inr => $val) {
                        $iquery = "SELECT * FROM Inventar WHERE Varenr = $inr";
                        $irow = mysqli_query($dbc, $iquery);
                        $result = mysqli_fetch_assoc($irow);
                        if ($result === null) {
                            $varenavn[$inr] = "[Ukjent vare]";
                        }
                        else {
                            $varenavn[$inr] = $result["Navn"];
                        }
                    }
                    /* uses the associative arrays to create table entries, as well as a button for deleting the entry */
                    /* $array = array($varenavn, $pris, $antall); */
                    foreach ($varenavn as $key => $value) {
                        echo '<tr>';
                        echo '<td>' .$key. '</td>';
                        echo '<td>' .$varenavn[$key]. '</td>';
                        echo '<td>' .$antall[$key]. '</td>';
                        echo '</tr>';
                    }
                }
                else {
                    echo '<tr><td> [Liste er tom] </td></tr>';
                }
            ?>

        </table>
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