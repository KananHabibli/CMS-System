<?php
 if(isset($_GET['edit_user'])){
     $id = escape($_GET['edit_user']);
     
      $query = "SELECT * FROM users WHERE user_id = {$id}";
      $select_users_query = mysqli_query($connection,$query);
      while($row=mysqli_fetch_assoc($select_users_query)){
      $user_id = $row['user_id'];
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['role']; 
 }
 }

if(isset($_POST['edit_user'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    
   /* $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];*/
    
    
    
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    
    if(!empty($user_password)){
        $query = "SELECT user_password FROM users WHERE user_id = $id";
        $result = mysqli_query($connection,$query);
        
        $row = mysqli_fetch_array($result);
        $db_password = $row['user_password'];
         
        if($db_password != $user_password){
            $hashed_password = password_hash($user_password,PASSWORD_BCRYPT , array('cost' => 12));
            
        }
     $query = "UPDATE users SET user_firstname = '{$user_firstname}' , user_lastname = '{$user_lastname}', role = '{$user_role}', username='{$username}', user_email = '{$user_email}', user_password = '{$hashed_password}' WHERE user_id = {$id} ";
    $result = mysqli_query($connection , $query);
    header('Location: users.php');   
    }
}

?>
   
    

   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
     <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    
    <select name="user_role" id="">
       <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
       <?php
        
         if($user_role == 'admin'){
             echo "<option value='subscriber'>Subscriber</option>";
             
         }else{
              echo "<option value='admin'>Admin</option>";
         }
        
        ?>
    
        
    </select> 
    
     
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Edit user">
     </div> 
</form>