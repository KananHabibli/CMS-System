<?php  include "includes/header.php" ?>
<?php  include "includes/db.php" ?>

<!-- Navigation -->
<?php  include "includes/nav.php" ?>


<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">



<?php 

if(isset($_GET['p_id'])){
$the_post_id = escape($_GET['p_id']);
    
//$view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id}";
//$send_query = mysqli_query($connection , $view_query);
    
    
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        ?>


        <!-- First Blog Post -->
<h2>
<a href="#"><?php  echo $post_title; ?></a>
</h2>
<p class="lead">
by <a href="index.php"><?php  echo $post_author; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted <?php  echo $post_date; ?></p>
<hr>
<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Error">
<hr>
<p><?php  echo $post_content; ?></p>


<hr>
   <?php } }else{

    header('Location: index.php');
} ?>

    <?php 
    if(isset($_POST['create_comment'])){
        $the_post_id = $_GET['p_id'];

        $comment_author = escape($_POST ['comment_author']);
        $comment_email = escape($_POST ['comment_email']);
        $comment_content = escape($_POST ['comment_content']);
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
            $insert_query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
        $comment_query = mysqli_query($connection , $insert_query);

//        $query = "UPDATE posts SET post_comment_id = post_comment_id + 1 WHERE post_id = $the_post_id ";
//        $update_comment_count_query = mysqli_query($connection , $update_comment_count_query);
        }else{
            echo "<script>alert('Fileds can't be empty')</script>";
        }
    }



?>

     <!-- Comments Form -->
<div class="well">
<h4>Leave a Comment:</h4>
<form action="" method="post" role="form">
<div class="form-group">
   <label for="Author">Author</label>
    <input type="text" class="form-control" name="comment_author">
</div>
<div class="form-group">
   <label for="email">Email</label>
    <input type="email" class="form-control" name="comment_email">
</div>
<div class="form-group">
   <label for="comment">Your Comment</label>
    <textarea name="comment_content" class="form-control" rows="3"></textarea>
</div>
<button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
</form>
</div>

<hr>

<!-- Posted Comments -->

<?php

$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
$select_comment_query = mysqli_query($connection , $query);
while($row = mysqli_fetch_array($select_comment_query)){
$comment_date = $row['comment_date'];
$comment_content = $row['comment_content'];
$comment_author = $row['comment_author'];

?>

<div class="media">
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"><?php echo $comment_author; ?>
    <small><?php echo $comment_date; ?></small>
</h4>
<?php echo $comment_content; ?>
</div>
</div>


<?php } ?>


<!-- Pager -->
<ul class="pager">
<li class="previous">
<a href="#">&larr; Older</a>
</li>
<li class="next">
<a href="#">Newer &rarr;</a>
</li>
</ul>

</div>

<!-- Blog Sidebar Widgets Column -->


<?php  include "includes/sidebar.php" ?>


</div>
<!-- /.row -->

<hr>

<!-- Footer -->

<?php  include "includes/footer.php" ?> 