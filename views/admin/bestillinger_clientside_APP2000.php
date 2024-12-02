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
    <title>Bestillinger</title>
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

        <h1>Bestillinger</h1>

        <table>
            <tr>
                <th class="number">Nr</th>
                <th class="date">Dato & tid</th>
                <th class="name">Kundenavn</th>
                <th class="email">E-post</th>
                <th class="address">Adresse</th>
                <th class="phonenr">Telefon</th>
                <th class="comments">Kommentar</th>
            </tr>
            <?php
        require('DB_connect.php'); /* Creates database connection */
        $query= "SELECT * FROM Ordre";
        $inv_list = $dbc->query($query);
        if ($inv_list->num_rows != 0) {
          $n=0; /* counter used for selection from array */
          $onrlist = array();
          while ($row = $inv_list->fetch_assoc()) {
            $onrlist[] = $row["Ordrenr"]; /* Adds orderID to array */
            echo '<tr>';
            echo '<td>' .$row["Ordrenr"]. '</td>';
            echo '<td>' .$row["DatoTid"]. '</td>';
            echo '<td>' .$row["Navn"]. '</td>';
            echo '<td>' .$row["E-post"]. '</td>';
            echo '<td>' .$row["Adresse"]. '</td>';
            echo '<td>' .$row["Telefon"]. '</td>';
            echo '<td>' .$row["Kommentar"].'</td>';
            echo '<td> <a href = "order_details.php?id='.$onrlist[$n].'"style = "text-decoration: none; color: black;"><button class="btn"">Detaljer</button></a></td>';
            echo '<td> <a href = "DB_archive_order.php?id='.$onrlist[$n].'"style = "text-decoration: none; color: black;"><button class="btn">Arkiver</button></td></a></td>';
            /* Adds the buttons for orderdetails and for archiving */
            echo '</tr>';
            $n += 1;
          }
        } else {
        echo 'Ingen bestillinger';}
      ?>
        </table>

        <div class="footer">
            <a href="nybestilling_clientside_APP2000.php">
                <div class="btn">Registrer<br> ny ordre</div>
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