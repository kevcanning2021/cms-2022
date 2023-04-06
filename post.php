<!-- Header -->
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
                    if(isset($_GET['p_id'])) {
                        $id = $_GET['p_id'];

                    $view_count_query = "UPDATE posts SET views_count = views_count + 1 WHERE id = {$id}";
                    $view_count_update = mysqli_query($connection, $view_count_query);

                    if(!$view_count_query) {
                        die("Query failed: " . mysqli_error($connection));
                    }
                    
                    $query = "SELECT * FROM posts WHERE id = {$id}";
                    $posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($posts)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $image = $row['image'];
                        $content = $row['content'];           
            ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $id; ?>"><?php echo $title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            <hr>
            <p>
                <?php echo $content; ?>
            </p>
            
            <hr>
            <?php } 
            } else {
                header("Location: index.php");
            }
                if(isset($_POST['create_comment'])) {
                    $id = $_GET['p_id'];

                    $author = $_POST['author'];
                    $email = $_POST['email'];
                    $comment = $_POST['comment'];

                    if(!empty($author) && !empty($email) && !empty($comment)) {
                        $query = "INSERT INTO comments (post_id, author, content, email, status, date) ";
                        $query .= "VALUES ('{$id}', '{$author}', '{$comment}', '{$email}', 'unapproved', now())";
    
                        $create_query = mysqli_query($connection, $query);
                        
                        if(!isset($create_query)) {
                            die('query failed: ' . mysqli_error($connection));
                        }   
                    } else {
                        echo "<script>alert('Fields can not be empty.');</script>";
                    }

                    // $query = "UPDATE posts SET comment_count = comment_count + 1 ";
                    // $query .= "WHERE id = {$id}";
            
                    $update_comment_count = mysqli_query($connection, $query);
            
                    if(!isset($update_comment_count)) {
                        die('query failed: ' . mysqli_error($connection));
                    }

                    header("Location: /post.php?p_id={$id}");
                }
            ?>

            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                <div class="form-group">
                    <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" name="author">
                    </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                    <label for="comment">Your Comment</label>
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <?php
                $post_id = $_GET['p_id'];

                $query = "SELECT * FROM comments WHERE post_id = {$post_id  } ";
                $query .= "AND status = 'approved' ";
                $query .= "ORDER BY id DESC";
                
                $comment_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($comment_query)) {
                    $author = $row['author'];
                    $date = $row['date'];
                    $content = $row['content'];
?>
                    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author; ?>
                            <small><?php echo $date; ?></small>
                        </h4>
                        <?php echo $content; ?>
                        <!-- Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                                commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce
                                condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment -->
                    </div>
                </div>
                <?php 
                }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>

    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php"; ?>