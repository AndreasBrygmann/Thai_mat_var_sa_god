<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meny</title>
    <link rel="stylesheet" href="../../src/css/kurv.css">
    <script src="../../src/js/confirmation.js" async></script>

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
</head>

<body>

    <header id="header"></header>

    <h2 id="category-title1">
        Bekreftelse
    </h2>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name=trim(strip_tags($_POST['name']));
            $adress=trim(strip_tags($_POST['adress']));
            $postalcode=trim(strip_tags($_POST['postalcode']));
            $town=trim(strip_tags($_POST['town']));
            $email=trim(strip_tags($_POST['email']));
            $phone=trim(strip_tags($_POST['phone']));
            $comment=trim(strip_tags($_POST['comment']));
        }
    ?>

    <div class="cart-container">
        <div class="food-list">
            <div>
                <form action="mottatt.php" method="POST">
                    <div id="confirmationData">
                        <input type="hidden" name="name" value="<?php echo $name ?>" readonly>

                        <input type="hidden" name="adress" value="<?php echo $adress ?>" readonly>

                        <input type="hidden" name="postalcode" value="<?php echo $postalcode ?>" readonly>

                        <input type="hidden" name="town" value="<?php echo $town ?>" readonly>

                        <input type="hidden" name="email" value="<?php echo $email ?>" readonly>

                        <input type="hidden" name="phone" value="<?php echo $phone ?>" readonly>

                        <input type="hidden" name="comment" value="<?php echo $comment ?>" readonly>

                        <p class="label">Navn</p>
                        <p class="userinfo"><?php echo $name ?></p>

                        <p class="label">Gate</p>
                        <p class="userinfo"><?php echo $adress ?></p>

                        <p class="label">Postnummer</p>
                        <p class="userinfo"><?php echo $postalcode ?></p>

                        <p class="label">By</p>
                        <p class="userinfo"><?php echo $town ?></p>

                        <p class="label">E-post</p>
                        <p class="userinfo"><?php echo $email ?></p>

                        <p class="label">Telefon</p>
                        <p class="userinfo"><?php echo $phone ?></p>

                        <p class="label">Kommentar</p>
                        <p class="userinfo"><?php echo $comment ?></p>

                        <div class="checkbox">
                            <input type="checkbox" id="nyhet" name="nyhet">
                            <label for="nyhet">Nyhetsbrev</label>
                            <input type="checkbox" id="bentingelser" name="betingelser">
                            <label for="betingelser">Godkjenn betingelser</label>
                            <input type="checkbox" id="kvittering" name="kvittering">
                            <label for="kvittering">Send kvittering på epost</label>
                        </div>

                        <div class="buttonpanel">
                            <input type="button" class="backbutton" onclick="window.location.href='faktura.html';"
                                value="Tilbake" />
                            <input type="submit" class="bekreft-button" value="Legg inn bestilling" />
                        </div>
                    </div>
                    <input style="visibility: hidden; display:none" type="hidden" name="ordercount" id="ordercount" value="0">
                </form>
            </div>
        </div>

    </div>
    <footer id="footer"></footer>

</body>

</html>