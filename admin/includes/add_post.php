<?php
    if(isset($_POST['create_post'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $status = $_POST['status'];
        
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('d-m-y');
        $comment_count = 0;

        move_uploaded_file($image_tmp, "../images/$image");

        $query = "INSERT INTO posts(category_id, title, author, date, image, content, tags, comment_count, status, views_count) ";
        $query .= "VALUES ('{$category_id}','{$title}', '{$author}',now(),'{$image}', '{$content}','{$tags}', '{$comment_count}', '{$status}', 0)";
        
        $create_post = mysqli_query($connection, $query);

        confirm_query($create_post);

        $id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post created successfully. <a href='../post.php?p_id={$id}'>View Post</a> OR <a href='posts.php'>Edit other posts</a><p>";
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
        <label for="users">Post User</label>
        <select name="users" id="" class="form-group form-control">
        
        <?php
            $query = "SELECT * FROM users";
            $get_user_query = mysqli_query($connection, $query);

            confirm_query($get_user_query);
    
            while($row = mysqli_fetch_assoc($get_user_query)) { 
                $id = $row['id']; 
                $username = $row['username']; 

                echo "<option value='{$id}'>{$username}</option>";
            }
     ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="" class="form-control">
            <option value="draft">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
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
        <textarea class="form-control" name="content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </div>
</form>