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
            $per_page = 5;

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            $query = "SELECT * FROM posts";                    
            $count_posts_query = mysqli_query($connection, $query);
            $num_count = mysqli_num_rows($count_posts_query);
            
            $post_per_page = ceil($num_count / $per_page);

            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";                    
            $posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($posts)) {
                $id = $row['id'];
                $title = $row['title'];
                $author = $row['author'];
                $date = $row['date'];
                $image = $row['image'];
                $content = substr($row['content'],0,100);  
                $status = $row['status']; 

                if($num_count == 0) {
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
                by <a href="author_posts.php?author=<?php echo $author; ?>&p_id=<?php echo $id; ?>"><?php echo $author; ?></a>
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

    <ul class="pager">
        <?php
            for($i = 1; $i <= $post_per_page; $i++) {
                if($i == $page) {
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }

        ?>
    </ul>
    <!-- Footer -->
    <?php include "includes/footer.php"; ?>