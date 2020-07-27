<?php
if(isset($_POST['create_user'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape(_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    
   /* $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];*/
    
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    
    $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 10));
   
    $query = "INSERT INTO users(user_firstname,user_lastname,username,role,user_email,user_password) VALUES('{$user_firstname}','{$user_lastname}','{$username}','{$user_role}','{$user_email}','{$user_password}')";
    $result = mysqli_query($connection,$query);

    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
    
    
}

?>
   
    

   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
     <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <select name="user_role" id="">
        <option value="select">Select</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select> 
    
     
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
     </div> 
</form>