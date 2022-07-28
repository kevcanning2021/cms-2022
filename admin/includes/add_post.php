<?php
    if(isset($_POST['create_post'])) {
        $id = $_GET['p_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $status = $_POST['status'];
        
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('d-m-y');
        // $comment_count = 4;

        move_uploaded_file($image_tmp, "../images/$image");

        $query = "INSERT INTO posts(category_id,title,author,date,image,content,tags,status)";
        $query .= "VALUES ('{$category_id}','{$title}', '{$author}',now(),'{$image}', '{$content}','{$tags}', '{$status}')";
        
        $create_post = mysqli_query($connection, $query);

        confirm_query($create_post);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category_id">Post Category</label>
        <select name="category_id" id="" class="form-group form-control">
        
        <?php
            $query = "SELECT * FROM categories";
            $get_category_query = mysqli_query($connection, $query);

            confirm_query($get_category_query);
    
            while($row = mysqli_fetch_assoc($get_category_query)) { 
                $id = $row['id']; 
                $title = $row['title']; 

                echo "<option value='{$id}'>{$title}</option>";
            }
     ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </div>
</form>