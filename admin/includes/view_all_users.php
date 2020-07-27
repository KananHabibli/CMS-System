<table class="table table-bordered table-hover bg-success">
<thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
</thead>
<tbody>
   <?php  
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['role']; 
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            if($row['role'] == 'admin'){
                echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            }else{
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";}
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

            echo "</tr>";
        } ?> 
     <?php 

    if(isset($_GET['delete'])){
        if(isset($_SESSION['role'])){
            if($_SESSION['role'] == 'admin'){
                $the_user_id =escape($_GET['delete']);
                $query= "DELETE FROM users WHERE user_id = {$the_user_id}";
                $result = mysqli_query($connection , $query);
                header('Location: users.php');
            }
        }
    }

    if(isset($_GET['change_to_admin'])){
        if(isset($_SESSION['role'])){
            if($_SESSION['role'] == 'admin'){
                $the_user_id = escape($_GET['change_to_admin']);
                $query= "UPDATE users SET role = 'admin' WHERE user_id = {$the_user_id}";
                $change_to_admin = mysqli_query($connection , $query);
                header('Location: users.php');
            }
        }

    }

     if(isset($_GET['change_to_sub'])){
          if(isset($_SESSION['role'])){
            if($_SESSION['role'] == 'admin'){
                $the_user_id = escape($_GET['change_to_sub']);
                $query= "UPDATE users SET role = 'subscriber' WHERE user_id = {$the_user_id}";
                $change_to_sub = mysqli_query($connection , $query);
                header('Location: users.php');
            }
          }
    }

    ?>
</tbody>
</table>
