<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkter</title>
    <link rel="stylesheet" type="text/css" href="../../src/css/food.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $("#header").load("../pages/pagesheader.html", function() {
            hamburgerMenu();
        });
        $("#footer").load("../pages/pagesfooter.html");
    });
    </script>
    <script type="text/javascript" defer src="../../src/js/hamburger-menu.js"></script>
    <script src="../../src/js/shop.js" async></script>
</head>

<body>

    <header id="header"></header>
    <main>
        <?php

    include_once '../../Clientpages/DB_connect.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM retter WHERE produktnr = $id";

    $result =mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Hent produktinformasjonen fra resultatet
        $row = mysqli_fetch_assoc($result);
        $productName = $row['navn'];
        $price = $row['pris'];
        $picture = $row['bilde'];
        $category = $row['kategori'];
        $information = $row['tekstinfo'];
        $allergens = $row['allergen'];
        $choice = $row['valg'];
        ?>

        <?php echo '<img class="food-container" src="../../src/img/' . $picture . '" >'?>
        <div class="food-info">
            <h1 class="navn"><?php echo $productName ?></h1>
            <p><?php echo $information ?></p>
            <p><?php echo $allergens ?></p>
        </div>

        <form action="test.php" class="form">
            <?php switch($choice){
            case 1:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="svin">Svin</option>
                <option value="scampi">Scampi</option>
            </select>
            <?php
                    break;
            case 2:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="vegetar">Vegetar</option>
            </select>
            <?php
                break;
            case 3:?>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="svin">Svin</option>
                <option value="innbaktSvin">Innbakt Svin</option>
                <option value="scampi">Scampi</option>
            </select>
            <?php
                break;
            case 4:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="svin">Svin</option>
                <option value="biff">Biff</option>
            </select>
            <?php
                break;
            case 5:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="biff">Biff</option>
            </select>
            <?php
                break;
            case 6:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="svin">Svin</option>
            </select>
            <?php
                break;
            case 7:?>
            <label for="tilpass">Tilpass:</label>
            <select name="tilpass" class="select-box">
                <option value="">Velg</option>
                <option value="kylling">Kylling</option>
                <option value="svin">Svin</option>
                <option value="biff">Biff</option>
                <option value="scampi">Scampi</option>
            </select>
            <?php
                break;
        }
        ?>

            <div class="submit">
                <?php echo '<p class="pris">'. $price . 'kr</p>'?>
                <button class="submit-btn" type="button">Legg til</button>
                <?php echo '<p class="varenr" hidden>'. $id . '</p>'?>
            </div>

        </form>


        <?php

      } else {
        echo 'Fant ikke produktet';
      }
    ?>

    </main>
    <footer id="footer"></footer>
</body>

</html>