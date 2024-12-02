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
    <title>Oppdater php og sql</title>
    <nav class="navbar">
        <a href="bestillinger_clientside_APP2000.php"><br>Bestillinger</a>
        <a href="arkiv_clientside_APP2000.php"><br>Arkiv</a>
        <a href="inventar_clientside_APP2000.php"><br>Inventar</a>
        <a href="sales.php"><br>Salgstatistikk</a>
    </nav>
</head>

<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $problem= FALSE;
            if(!empty($_POST['varenr'])&&!empty($_POST['varenavn'])&&!empty($_POST['enhet'])&&!empty($_POST['antall']&&!empty($_POST['pris']))){
                $varenr=trim(strip_tags($_POST['varenr']));	
                $varenavn=trim(strip_tags($_POST['varenavn']));
                $enhet=trim(strip_tags($_POST['enhet']));
                $antall=trim(strip_tags($_POST['antall']));
                $pris=trim(strip_tags($_POST['pris']));				
            }
            else{
                echo "<p style="."color:red".">Skriv inn all informasjon<br></p>";
                $problem=TRUE;
            }
            if(!$problem){
                require("DB_connect.php");
                $updateQuery= "UPDATE Inventar SET Varenr='$varenr', Navn='$varenavn', Enhet='$enhet', Antall='$antall', Pris='$pris' WHERE Varenr='$varenr'";							
                mysqli_query($dbc, $updateQuery);
                    if(mysqli_affected_rows($dbc)==1){
                        echo "<p>Inventar oppdatert!</p>";
                        echo "<a href='inventar_clientside_APP2000.php'>Tilbake til Inventar side</a>";
                    }
                    else{
                        echo "<p>Noe gikk galt</p>";
                    }					
                }
                                    
            mysqli_close($dbc);
                            
        }
   ?>
</body>

</html>

<?php
}
else{
  header("Location: ../../login_index.php?");
  exit();
}
?>