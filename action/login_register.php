<?php

//connect DB

include '../includes/db_config.php';

if(isset($_POST['register'])){

    $user_id = $_POST['user_id'];

    $first_name = $_POST['first_name'];

    $last_name = $_POST['last_name'];

    $email = $_POST['email'];

    $username = $_POST['username'];

    $password = $_POST['password'];

    $confirm_password = $_POST['confirm_password'];

    // Confirm Password Validation
    
    if($password != $confirm_password){

        header("Location: ../register.php?status=mismatch");
        exit();

    }
    else{

        // Email

        $email_check = "SELECT * FROM user
                        WHERE email='$email'";

        $email_result = mysqli_query($conn, $email_check);

        // Username

        $username_check = "SELECT * FROM user
                           WHERE username='$username'";

        $username_result = mysqli_query($conn, $username_check);

        // User_ID

        $userid_check = "SELECT * FROM user
                         WHERE user_id='$user_id'";

        $userid_result = mysqli_query($conn, $userid_check);

        //If exists

        // Email Exists

        if(mysqli_num_rows($email_result) > 0){

            header("Location: ../register.php?status=email_exists");
            exit();

        }

        // Username Exists
        elseif(mysqli_num_rows($username_result) > 0){

            header("Location: ../register.php?status=user_exists");
            exit();

        }

        // User ID Exists
        elseif(mysqli_num_rows($userid_result) > 0){

            header("Location: ../register.php?status=id_exists");
            exit();

        }

        else{

            // Insert Data
            $encrypt_password = md5($password);

            $query = "INSERT INTO user
            (user_id, email, first_name, last_name, username, password)

            VALUES('$user_id','$email','$first_name','$last_name','$username','$encrypt_password')";

            $result = mysqli_query($conn, $query);

            if($result){
                header("Location: ../index.php?status=success");
                exit();

            }
            else{

                echo "Registration Failed";

            }

        }

    }
}
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password exist in the same row
    $encrypt_password = md5($password);

    $query = "SELECT * FROM user WHERE username='$username' AND password='$encrypt_password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        // Matching user found
        header("Location: ../dashboard.php");
        exit();
    } 
    else {

        // No match found
        header("Location: ../index.php?status=invalid");
        exit();
    }
}
?>