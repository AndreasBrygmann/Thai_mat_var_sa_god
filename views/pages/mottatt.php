<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mottatt</title>
    <link rel="stylesheet" href="../../src/css/kurv.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $("#header").load("pagesheader.html", function() {
            hamburgerMenu();
        });
        $("#footer").load("pagesfooter.html");
    });
    </script>
    <script type="text/javascript" defer src="../../src/js/hamburger-menu.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
</head>

<body>

    <header id="header"></header>
    <h2 id="category-title1">
        Handlekurv
    </h2>

    <div class="cart-container">
        <div class="food-list">
            <ul>
                <?php
        $ordersuccess = False;
        $orderlinesuccess = False;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kundenavn=trim(strip_tags($_POST['name']));
            $adresse=trim(strip_tags($_POST['adress']));
            $epost=trim(strip_tags($_POST['email']));
            $telefon=trim(strip_tags($_POST['phone']));
            $kommentar=trim(strip_tags($_POST['comment']));

            include("../admin/DB_generate_ordernr.php");
            $datotid=date("Y-m-d H:i:s");

            require('../admin/DB_connect.php');

            $n=trim(strip_tags($_POST['ordercount']));
            for ($i=0; $i < $n; $i++) { 
                $varenr=trim(strip_tags($_POST["varenr_$i"]));
                $antall=trim(strip_tags($_POST["antall_$i"]));
                $rowquery = "INSERT INTO Ordrelinje (`Ordrenr`, `Varenr`, `Antall`) VALUES ('$ordrenr', '$varenr', '$antall')";
                if (mysqli_query($dbc, $rowquery)) {
                    $orderlinesuccess = True;
                }
                else {
                    echo "<p style="."color:red".">Ordre ble ikke lagret fordi:<br>".
                    mysqli_error($dbc).". 
                    </p><p>The query being run was: ".$rowquery."</p>
                    <p>Kontakt IT-ansvarlig</p>";
                    return;
                }
            }
                
            $orderquery = "INSERT INTO Ordre (`Ordrenr`, `DatoTid`, `Navn`, `E-post`, `adresse`, `Telefon`, `Kommentar`) VALUES ('$ordrenr', '$datotid', '$kundenavn', '$epost', '$adresse', '$telefon', '$kommentar')";
            if (mysqli_query($dbc, $orderquery)){
                	$ordersuccess = True;			
                }
                else{
                    echo "<p style="."color:red".">Ordre ble ikke lagret fordi:<br>".
                    mysqli_error($dbc).". 
                    </p><p>The query being run was: ".$orderquery."</p>
                    <p>Kontakt IT-ansvarlig</p>";
                }
                mysqli_close($dbc);

            if ($ordersuccess == True && $orderlinesuccess == True) {
                echo "<p style="."text-align: center".">Bestilling er mottatt. Ditt ordrenummer er: ".$ordrenr."<br><br>
                Kvittering er sendt ikke sendt på epost.<br><br>
                Takk for handelen!</p>";
            }
        }
    ?>
                <script>
                localStorage.clear();
                </script>

            </ul>
        </div>
    </div>
    </a>
    <footer id="footer"></footer>
</body>

</html>