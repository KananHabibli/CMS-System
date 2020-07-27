<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

if(isset($_POST['login'])){
    
   $username = escape($_POST['username']);
   $password = escape($_POST['password']);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection , $query);
    
    while($row = mysqli_fetch_array($select_user_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['role'];
    }
    //$password = crypt($password , $db_password);
    
    if($username === $db_username && $password === $db_password){ 
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_firstname;
        $_SESSION['user_lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;
        header("Location: ../admin");}
    else{
        header("Location: ../index.php");
}
    }


?>