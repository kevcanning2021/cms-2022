<?php
if(isset($_GET['p_id'])) {
    $id = $_GET['p_id'];
}
                $query = "SELECT * FROM posts WHERE id={$id}";
                $query_by_id = mysqli_query($connection, $query);

                confirm_query($query_by_id);
            
                while($row = mysqli_fetch_assoc($query_by_id)) { 
                    $id = $row['id']; 
                    $title = $row['title']; 
                    $author = $row['author']; 
                    $category_id = $row['category_id']; 
                    $status = $row['status']; 
                    $image = $row['image']; 
                    $tags = $row['tags']; 
                    $comment_count = $row['comment_count']; 
                    $content = $row['content']; 
                }

                if(isset($_POST['edit_post'])) {
                    $title = $_POST['title']; 
                    $author = $_POST['author']; 
                    $category_id = $_POST['category_id']; 
                    $status = $_POST['status']; 

                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];

                    $tags = $_POST['tags']; 
                    $comment_count = 4; 
                    $content = $_POST['content']; 

                    move_uploaded_file($image_tmp, "../images/$image");

                    if(empty($image)) {
                        $query = "SELECT * FROM posts WHERE id = '{$id}'";

                        $image_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($image_query)) {
                            $image = $row['image'];
                        }

                    }

                    $query = "UPDATE posts SET ";
                    $query .= "title = '{$title}', ";
                    $query .= "author = '{$author}', ";
                    $query .= "category_id = '{$category_id}', ";
                    $query .= "date = now(), ";
                    $query .= "image = '{$image}', ";
                    $query .= "content = '{$content}', ";
                    $query .= "tags = '{$tags}', ";
                    $query .= "comment_count = '{$comment_count}', ";
                    $query .= "status = '{$status}' ";
                    $query .= "WHERE id = '{$id}'";

                    $update_query = mysqli_query($connection, $query);

                    confirm_query($update_query);
                }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
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
        <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
        <br>
        <img src="../images/<?php echo $image; ?>" alt="" width="150">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $tags; ?>">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
    </div>
</form>