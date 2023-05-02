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
                        $author = $_GET['author'];
                    }

                    $query = "SELECT * FROM posts WHERE user = '{$author}'";
                    
                    $posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($posts)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $user = $row['user'];
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
                All posts by <?php echo $user; ?>
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
                if(isset($_POST['create_comment'])) {
                    $id = $_GET['p_id'];

                    $user = $_POST['user'];
                    $email = $_POST['email'];
                    $comment = $_POST['comment'];

                    if(!empty($user) && !empty($email) && !empty($comment)) {
                        $query = "INSERT INTO comments (post_id, user, content, email, status, date) ";
                        $query .= "VALUES ('{$id}', '{$user}', '{$comment}', '{$email}', 'unapproved', now())";
    
                        $create_query = mysqli_query($connection, $query);
                        
                        if(!isset($create_query)) {
                            die('query failed: ' . mysqli_error($connection));
                        }   
                    } else {
                        echo "<script>alert('Fields can not be empty.');</script>";
                    }

                    $query = "UPDATE posts SET comment_count = comment_count + 1 ";
                    $query .= "WHERE id = {$id}";
            
                    $update_comment_count = mysqli_query($connection, $query);
            
                    if(!isset($update_comment_count)) {
                        die('query failed: ' . mysqli_error($connection));
                    }
                }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>

    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php"; ?>