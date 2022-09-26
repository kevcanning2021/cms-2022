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
                    $query = "SELECT * FROM posts";
                    
                    $posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($posts)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $image = $row['image'];
                        $content = substr($row['content'],0,100);  
                        $status = $row['status']; 

                        if($status !== 'published') {
                            echo " <h1 class='text-center'>Sorry, there are no published posts avaliable.</h1>";
                        } else {
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
            <a href="post.php?p_id=<?php echo $id; ?>"><img class="img-responsive" src="images/<?php echo $image; ?>" alt=""></a>
            <hr>
            <p>
                <?php echo $content; ?>
            </p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <?php 
            } 
        }?>           
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>

    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php"; ?>