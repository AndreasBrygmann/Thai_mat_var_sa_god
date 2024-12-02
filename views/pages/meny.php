<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meny</title>
    <link rel="stylesheet" href="../../src/css/meny.css">
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
    <script type="text/javascript" defer src="../../src/js/meny.js"></script>
    <script src="../../src/js/shop.js" async></script>

</head>

<body>

    <header id="header"></header>

    <?php
        include_once '../../Clientpages/DB_connect.php';

        $kategori = "all";

        // getting and setting the button category
        if (isset($_GET['kategori'])) {
            $kategori = $_GET['kategori'];
        }

        // getting the data based on category
        if ($kategori == "all") {
            $sql = "SELECT * FROM retter";
        } else {
            $sql = "SELECT * FROM retter WHERE kategori='$kategori'";
        }

        $result = mysqli_query($dbc, $sql);

    ?>



    <menu id="menu-btns">

        <?php
            // Getting the category from the url, defaulting to 'all'
            if(isset($_GET['kategori'])) {
                $kategori = $_GET['kategori'];
            } else {
                $kategori = 'all';
            }

            // creating an array with categories and it's text
            $kategorier = array(
                'all' => 'Alle retter',
                '1' => 'Forretter',
                '2' => 'Middag',
                '3' => 'Tilbehør',
                '4' => 'Drikke',
                '5' => 'Pizza'
            );

            // Looping through the array and generate a button for each category
            foreach ($kategorier as $key => $value) {
                echo '<a href="?kategori=' . $key . '">';
                echo '<button id="btn' . $key . '"';
                    if ($kategori == $key) {
                        echo ' class="active"';
                    }
                echo '>' . $value . '</button>';
                echo '</a>'; 
            }
        ?>

    </menu>


    <main>

        <?php        
        // Using a while loop to get the data from result 

            while($row = mysqli_fetch_assoc($result)){
                $productName = $row['navn'];
                $price = $row['pris'];
                $picture = $row['bilde'];
                $category = $row['kategori'];
                $productId = $row['produktnr'];
                $link = '../foods/produkt.php?id=' . $productId;

                ?>

        <a href="<?php echo $link?>" class="card">
            <div class="image">
                <img src="../../src/img/<?php echo $picture?>" alt="<?php echo $productName?>">
            </div>
            <div class="caption">
                <p class="name"><?php echo $productName?></p>
                <p class="rate"><?php echo $price?> kr</p>
            </div>
        </a>

        <?php
            }
            mysqli_close($dbc);
        ?>

    </main>

    <footer id="footer"></footer>
</body>

</html>