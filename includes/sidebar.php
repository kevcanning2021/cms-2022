<div class="col-md-4">
<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search"  type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
<?php
                    $query = "SELECT * FROM categories";
                    $categories = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($categories)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        
                        echo "<ul class='list-unstyled'>";
                        echo "<li><a href='category.php?category=$id'>$title</a></li>";
                        echo "</ul>";
                    }
                    ?>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>