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
    <title>Ny bestilling</title>
    <!-- Dette skriptet legger til en ny varelinje -->
    <script>
    var n = 0;

    function addInput() {
        var breakNode = document.createElement("br");

        var input = document.createElement("input");
        input.type = "text";
        input.name = "varenr_" + n
            .toString(); /* Lager et unikt navn til feltet som ser slik ut: varenr_0, varenr_1 osv... */
        input.placeholder = "varenr...";

        var container = document.getElementById('ordrelinje');
        container.appendChild(breakNode);
        container.appendChild(input);

        var input = document.createElement("input");
        input.type = "text";
        input.name = "antall_" + n.toString();
        input.placeholder = "antall...";

        var container = document.getElementById('ordrelinje');
        container.appendChild(input);

        n += 1;

        document.order.ordercount.value = n;
    }
    </script>
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

        <h1>Ny bestilling</h1>

        <?php
            require('DB_generate_ordernr.php') /* Dette generer et ordrenr med variabelen $ordrenr */
            ?>
        <!-- <a href="logout.php" style="text-decoration: none; color: black;">
            <div class="btn" style="top: 50px; right: 50px; position: fixed;">Logg ut</div>
        </a> -->

        <a href="bestillinger_clientside_APP2000.php" style="text-decoration: none; color: black;">
            <div class="btn" style="bottom: 50px; right: 50px; position: fixed;">Tilbake</div>
        </a>

        <form name="order" action="DB_insert_order.php" method="POST">
            <label for="ordrenr">Ordrenr</label><br>
            <input type="text" name="ordrenr" value="<?php echo $ordrenr; ?>" readonly><br>
            <!-- setter inn ordrenr kan ikke endres av bruker -->
            <label for="ordrenr">Kundenavn</label><br>
            <input type="text" name="kundenavn"><br>
            <label for="epost">E-post</label><br>
            <input type="text" name="epost"><br>
            <label for="adresse">Adresse</label><br>
            <input type="text" name="adresse"><br>
            <label for="telefon">Telefon</label><br>
            <input type="text" name="telefon"><br>
            <label for="kommentar">Kommentar</label><br>
            <input type="text" name="kommentar"><br><br>

            <button type="button" onclick="addInput()">Legg til varelinje</button> <!-- Legger til en ny varelinje -->
            <div id="ordrelinje"></div>

            <input type="hidden" id="ordercount" name="ordercount" value="n">
            <input type="submit" value="Lagre" class="btn" style="padding: 5px 10px; font-size:13px; margin-top:1em;">
        </form>

    </div>
</body>

<?php
}
else{
  header("Location: ../../login_index.php?");
  exit();
}
?>