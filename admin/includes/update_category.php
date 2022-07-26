<form action="" method="post">
    <label for="title">Edit Category</label>
    <?php
        if(isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE id = {$id}";
        $edit_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($edit_query)) { 
        $id = $row['id']; 
        $title = $row['title']; 
    ?>

    <div class="form-group">
        <input type="text" name="title" class="form-control" value="<?php if(isset($title)) {  echo $title; } ?>">
    </div>
    <?php } }

    if(isset($_POST['update'])) {
        $update_title = $_POST['title'];
        $id = $_GET['edit'];
        
        $query = "UPDATE categories SET title = '{$update_title}' WHERE id = $id";
        $update_query = mysqli_query($connection, $query);
        
        confirm_query($update_query);
        
        header("Location: categories.php");
    }
    ?>
    <div class="form-group">
        <input type="submit" name="update" value="Update Category" class="btn btn-primary">
    </div>
</form>