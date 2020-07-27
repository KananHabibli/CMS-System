<?php  include "includes/header.php"; ?>
<?php 

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection , $query);
    while($row = mysqli_fetch_array($result)){
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


?>
    
<?php
if(isset($_POST['edit_profile'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    
   /* $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];*/
    
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
   
    $query = "UPDATE users SET user_firstname = '{$user_firstname}' , user_lastname = '{$user_lastname}', role = '{$user_role}', username='{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE username = '{$username}' ";
    $result = mysqli_query($connection , $query);
    header('Location: users.php');
}



?>
    <div id="wrapper">

        <!-- Navigation -->
       <?php  include "includes/nav.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php
                                echo $_SESSION['username'];
                            ?></small>
                        </h1>
                        
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
       <option value="subscriber"><?php echo $user_role; ?></option>
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
         <input class="btn btn-primary" type="submit" name="edit_profile" value="Edit profile">
     </div> 
</form>
                        
                    </div>
                      </div> 
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        
        <!-- /#page-wrapper -->
    <?php  include "includes/footer.php" ?>
    
