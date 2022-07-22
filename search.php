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
    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        $query = "SELECT * FROM posts WHERE tags LIKE '%$search%'";
        $search_query = mysqli_query($connection, $query);

        if(!$search_query) {
            die("Query Failed " . mysqli_error($connection));
        }

        $count = mysqli_num_rows($search_query);

        if($count == 0) {
            echo "<h1>No result</h1>";
        } else {
                    while($row = mysqli_fetch_assoc($search_query)) {
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
                <a href="#"><?php echo $title; ?></a>
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
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <?php }
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