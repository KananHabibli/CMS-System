<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    
    if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) ){
    $username  = escape($username);
    $firstname = escape($firstname);
    $lastname  = escape($lastname);
    $email     = escape($email);
    $password  = escape($password);
        
    $password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));
    
//    $query = "SELECT randSalt FROM users";
//    $select_randsalt_query = mysqli_query($connection,$query);
//    
//    
//    $row = mysqli_fetch_array($select_randsalt_query);
//    $salt = $row['randSalt'];
//    $password = crypt($password , $salt);
    
    $query = "INSERT INTO users (username , user_firstname , user_lastname , user_email , user_password , role) VALUES('{$username}','{$firstname}','{$lastname}','{$email}','{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection , $query);
    $message = "Your registration is submitted";
    }else{
        $message = "Fields can not be empty";
    }
    
}else{
    $message = ''; 
}





?>
   
   
   
    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
<div class="container">
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
    <div class="form-wrap">
    <h1>Register</h1>
        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
          <h6 class="text-center"><?php echo $message  ?></h6>
           <div class="form-group">
                <label for="firstname" class="sr-only">First name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Your First Name">
            </div>
            <div class="form-group">
                <label for="lastname" class="sr-only">Last name</label>
                <input type="text" name="lastname" id="username" class="form-control" placeholder="Your Last Name">
            </div>
            <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
            </div>
             <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
            </div>
             <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
            </div>

            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
        </form>

    </div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->
</div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
