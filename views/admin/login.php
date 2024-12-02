<?php
session_start();
include "DB_connect.php";
    if(isset($_POST['username']) && isset($_POST['password'])){

        //trimming input fields and converting special chars
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        if(empty($username)){
            header("Location: ../../login_index.php?error=Tast inn brukernavn");
            exit();
        } else if(empty($password)){
            header("Location: ../../login_index.php?error=Tast inn passord");
            exit();
        } else {
            //selecting against the db to check if username/password is valid
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

            $result = mysqli_query($dbc, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $username && $row['password'] === $password){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    //successful login creates a session required for the other pages
                    header("Location: bestillinger_clientside_APP2000.php");
                    exit();
                } else{
                    header("Location: ../../login_index.php?error=Feil brukernavn eller passord");
                    exit();
                }

                
            } else{
                header("Location: ../../login_index.php?error=Feil brukernavn eller passord");
                exit();
            }
        }

    } else{
        header("Location: ../../login_index.php");
        exit();
    }

?>