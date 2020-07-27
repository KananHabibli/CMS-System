<form action="" method="post">
     <label for="cat-title">Edit category</label>

     <?php
      if(isset($_GET['edit'])){
        $cat_id = escape($_GET['edit']);
        $edit_query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
        $result = mysqli_query($connection , $edit_query);
           while($row=mysqli_fetch_assoc($result)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
              ?>
              <div class="form-group">
              <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" type="text" class="from-control" name="cat_title">
      </div>
   <?php  } }

      ?>

      <?php
      if(isset($_POST['update'])){
          $updated_title = escape($_POST['cat_title']);
          $update_query = "UPDATE categories SET cat_title = '{$updated_title}' WHERE cat_id = {$cat_id}";
          $result = mysqli_query($connection,$update_query);
          header('Location: categories.php');
          if(!$result){
              echo "no";
          }
      }

        

      ?>
      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update" value="Edit">
      </div>

  </form>