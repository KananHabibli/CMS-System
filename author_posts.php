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
$the_post_author = escape($_GET['author']);

$query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
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
All posts by <?php  echo $post_author; ?>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted <?php  echo $post_date; ?></p>
<hr>
<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Error">
<hr>
<p><?php  echo $post_content; ?></p>


<hr>
   <?php } }else{

    include "index.php";
} ?>

    <?php 
    if(isset($_POST['create_comment'])){
        $the_post_id = escape($_GET['p_id']);

        $comment_author = escape($_POST ['comment_author']);
        $comment_email = escape($_POST ['comment_email']);
        $comment_content = escape($_POST ['comment_content']);
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
            $insert_query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
        $comment_query = mysqli_query($connection , $insert_query);

        $query = "UPDATE posts SET post_comment_id = post_comment_id + 1 WHERE post_id = $the_post_id ";
        $update_comment_count_query = mysqli_query($connection , $update_comment_count_query);
        }else{
            echo "<script>alert('Fields can't be empty')</script>";
        }
    }



?>



<hr>




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