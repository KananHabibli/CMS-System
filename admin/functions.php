<?php

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}




function users_online(){
global $connection;
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session' ";
$send_query = mysqli_query($connection , $query);
$count = mysqli_num_rows($send_query);

if($count == NULL){
    mysqli_query($connection , "INSERT INTO users_online(session,time) VALUES ('$session' , '$time')");
}else{
    mysqli_query($connection , "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
}

$users_online_query = mysqli_query($connection , "SELECT * FROM users_online WHERE time > '$time_out' ");
return $count_user = mysqli_num_rows($users_online_query);
}



function insert_categories(){
    if(isset($_POST['submit'])){
        global $connection;
         $cat_title = escape($_POST['cat_title']);
         if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
         }else{
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
            $create_category = mysqli_query($connection , $query);
                                    
              }
          }
    
}
function findAllCategories(){
        
  global $connection;
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection , $query); 
   while($row=mysqli_fetch_assoc($result)){
       $cat_id = $row['cat_id'];
       $cat_title = $row['cat_title'];
       echo "<tr>";
       echo "<td>{$cat_id}</td>";
       echo "<td>{$cat_title}</td>";
       echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
       echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
       echo "</tr>";
        }
}


function delete_category(){
    if(isset($_GET['delete'])){
        global $connection;
        $the_cat_id = escape($_GET['delete']);
      $delete_query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
      $result = mysqli_query($connection,$delete_query);
      header("Location: categories.php");
       }
}







?>