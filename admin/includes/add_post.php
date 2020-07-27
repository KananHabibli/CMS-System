<?php
if(isset($_POST['create_post'])){
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
   // $post_comment_count = 4;
    
    move_uploaded_file($post_image_temp , "../images/$post_image");


$query = "INSERT INTO posts(post_category_id , post_title , post_author , post_date , post_image , post_content , post_tags , post_status) VALUES({$post_category_id} , '{$post_title}' , '{$post_author}' , now() , '{$post_image}' , '{$post_content}' , '{$post_tags}' , '{$post_status}')";
 $result = mysqli_query($connection , $query);
 $the_post_id =  mysqli_insert_id($connection);
 echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Posts</a></p>";
}
?>
   
    
    
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <label for="category">Category</label>
        <select name="post_category" id="">
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
       <label for="username">Username</label>
        <select name="username" id="">
            <?php 
            $query = "SELECT * from users";
            $result = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
            }
            ?> 
        </select>
    </div>
    
     
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    
    <div class="form-group">
        
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
        
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
     </div>
     
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="body" cols="30" rows="10" class="form-control"></textarea>
     </div> 
     
    <div class="form-group">
        <input type="submit" class="btn btn-primary" type="submit" name="create_post" value="Publish Post">    
    </div>
</form>