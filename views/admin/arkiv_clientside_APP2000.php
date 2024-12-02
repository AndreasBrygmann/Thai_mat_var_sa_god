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
    <title>Arkiv</title>
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

        <h1>Arkiv</h1>

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
              require('DB_connect.php');
              $query= "SELECT * FROM Arkiv";
              $arch_list = $dbc->query($query);
              if ($arch_list->num_rows != 0) {
                $n=0;
                $onrlist = array();
                while ($row = $arch_list->fetch_assoc()) {
                  $onrlist[] = $row["Ordrenr"];
                  echo '<tr>';
                  echo '<td>' .$row["Ordrenr"]. '</td>';
                  echo '<td>' .$row["DatoTid"]. '</td>';
                  echo '<td>' .$row["Navn"]. '</td>';
                  echo '<td>' .$row["E-post"]. '</td>';
                  echo '<td>' .$row["Adresse"]. '</td>';
                  echo '<td>' .$row["Telefon"]. '</td>';
                  echo '<td>' .$row["Kommentar"]. '</td>';
                  echo '<td> <a href = "Archive_details.php?id='.$onrlist[$n].'"style = "text-decoration: none; color: black;"><button class="btn">Detaljer</button></a></td>';
                  echo '</tr>';
                  $n += 1;
                }
              } else {
              echo '<tr><td>Arkiv tomt</td></tr>';}
            ?>
        </table>

        <div class="footer">
            <div class="btn" onclick="confirmation()">Tøm arkiv</div>
            <!-- <a href="DB_delete_old_archive.php"><div class="btn">Dato sjekk</div></a> -->
        </div>

    </div>
</body>
<script>
  function confirmation() {
    let messg = "Dette vill slette alt innholdet i arkiv\nTrykk Ok for å bekrefte";
    if (confirm(messg) == true) {
      window.location.href = "DB_clear_archive.php"
    }
  }
</script>

</html>

<?php
}
else{
  header("Location: ../../login_index.php?");
  exit();
}
?>