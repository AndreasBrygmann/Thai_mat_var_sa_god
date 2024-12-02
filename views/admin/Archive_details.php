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
    <title>Ordredetaljer</title>
    <nav class="navbar">
        <a href="bestillinger_clientside_APP2000.php"><br>Bestillinger</a>
        <a href="arkiv_clientside_APP2000.php"><br>Arkiv</a>
        <a href="inventar_clientside_APP2000.php"><br>Inventar</a>
        <a href="sales.php"><br>Salgstatistikk</a>
    </nav>
</head>

<body>

    <div class="container">


        <div class="header">
            <a href="logout.php">
                <div class="btn">Logg ut</div>
            </a>
        </div>



        <h1>Ordrelinjer</h1>
        <table>
            <tr>
                <th>Varenr</th>
                <th>Antall</th>
            </tr>
            <!-- Generates table elements from database -->
            <?php
            $ordrenr=$_GET['id'];
            require('DB_connect.php');
            $query = "SELECT * FROM Ordrelinje WHERE Ordrenr = $ordrenr";
            $ordrelinjer = $dbc->query($query);
            if ($ordrelinjer->num_rows != 0) {
                while ($row = $ordrelinjer->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' .$row["Varenr"]. '</td>';
                    echo '<td>' .$row["Antall"]. '</td>';
                    echo '</tr>';
                }
            }
            else {
                echo '<tr><td> [Ingen varelinjer] </td></tr>';
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