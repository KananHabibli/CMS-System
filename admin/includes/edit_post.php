<?php
    if(isset($_GET['p_id'])){
        $the_post_id = escape($_GET['p_id']);    
    }
$query = "SELECT * from posts WHERE post_id = {$the_post_id}";
$result = mysqli_query($connection,$query);
 while($row=mysqli_fetch_assoc($result)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
 }

if(isset($_POST['edit_post'])){
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
        $image_result = mysqli_query($connection , $query);
        while($row = mysqli_fetch_array($image_result)){
            $post_image = $row['post_image'];
        } 
    }
    $query = "UPDATE posts SET post_title = '{$post_title}' , post_category_id = '{$post_category_id}', post_date = now() , post_author = '{$post_author}',post_status='{$post_status}',post_tags = '{$post_tags}',post_content = '{$post_content}',post_image = '{$post_image}' WHERE post_id = {$the_post_id} ";
    $result = mysqli_query($connection , $query);
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Posts</a></p>";
}
?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="post_category" id="post_category">
           <?php 
            $query = "SELECT * from categories";
            $result = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    
    
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
    </div>
    
     
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
            <select name="post_status" id="">

                <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
                <?php
                if($post_status == 'published'){
                    echo "<option value='draft'>draft</option>";
                }else{
                    echo "<option value='published'>published</option>";
                }
                ?>
            </select>
       </div>
    

     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input  value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
     </div>
     
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="body" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
     </div> 
     
    <div class="form-group">
        <input type="submit" class="btn btn-primary" type="submit" name="edit_post" value="Update Post">    
    </div>
</form>