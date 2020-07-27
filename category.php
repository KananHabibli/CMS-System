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
                if(isset($_GET['category'])){
                    $post_category_id = escape($_GET['category']);
                }
                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id ";
                $result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                ?>
                                
                                
                                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php  echo $post_id; ?>"><?php  echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php  echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted <?php  echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Error">
                <hr>
                <p><?php  echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
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