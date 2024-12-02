<?php
/* session_start([
  //Cookie valied only for 1 day or till closed
  'cookie_lifetime' => 86400,
  'read_and_close' => true,
]);

if(isset($_SESSION['id']) && isset($_SESSION['username'])){
 */
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- This code generates a new ordernumber (orderID) -->
    <?php
        require('DB_connect.php');
        $nrquery = "SELECT MAX(Ordrenr) FROM Ordre"; /* Retrieves the highest value from ordernumbers */
        if ($row = mysqli_query($dbc, $nrquery)) {
            /* If there are no elements in Ordre the ordernumber is set to 1 */
            if (mysqli_affected_rows($dbc)==0) {
                $ordrenr = '1';
            }
            else {
                /* converts highest ordernr to a variable and ads 1 */
                $row = mysqli_query($dbc, $nrquery);
                $result = mysqli_fetch_array($row);
                $ordrenr = $result[0]+1;
            }
        }
    ?>
</body>

</html>

<?php
/* }
else{
  header("Location: login_index.php?");
  exit();
} */
?>