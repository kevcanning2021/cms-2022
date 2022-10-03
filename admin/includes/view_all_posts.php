<?php
    if(isset($_POST['checkbox_array'])) {
        foreach($_POST['checkbox_array'] as $checkbox) {
            $bulk_options = $_POST['bulk_options'];        
            
            switch($bulk_options){
                case 'published': 
                    $query = "UPDATE posts SET status = '{$bulk_options}' WHERE id = {$checkbox} ";
                    $update_publish_post = mysqli_query($connection, $query);
                    confirm_query($update_publish_post);
                    break;
                case 'draft': 
                    $query = "UPDATE posts SET status = '{$bulk_options}' WHERE id = {$checkbox}";
                    $update_draft_post = mysqli_query($connection, $query);
                    confirm_query($update_draft_post);
                    break;
                case 'delete': 
                    $query = "DELETE FROM posts WHERE id = {$checkbox}";
                    $delete_post = mysqli_query($connection, $query);
                    confirm_query($delete_post);
                    break;
            }
        }
    }
?>

<form action="" method="post">
<table class="table table-bordered table-hover">
    <div id="bulk_options_container" class="col-xs-4">
        <select name="bulk_options" class="form-control">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <thead>
        <tr>
            <th><input type="checkbox" id="select_boxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM posts";
            $all_posts_query = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($all_posts_query)) { 
                $id = $row['id']; 
                $author = $row['author']; 
                $category_id = $row['category_id']; 
                $status = $row['status']; 
                $image = $row['image']; 
                $tags = $row['tags']; 
                $comment_count = $row['comment_count']; 
                $date = $row['date']; 

                echo "<tr>";
                echo "<td><input class='check_boxes' type='checkbox' name='checkbox_array[]' value='{$id}'></td>";
                echo "<td>{$id}</td>";
                echo "<td>{$author}</td>";

                $query = "SELECT * FROM categories WHERE id = {$category_id}";
                $edit_query = mysqli_query($connection, $query);
        
                while($row = mysqli_fetch_assoc($edit_query)) { 
                    $title = $row['title']; 

                    echo "<td>{$title}</td>";
                }

                echo "<td>{$status}</td>";
                echo "<td><img src='../images/{$image}' class='img-responsive' style='width:100px;'/></td>";
                echo "<td>{$tags}</td>";
                echo "<td>{$comment_count}</td>";
                echo "<td>{$date}</td>";
                echo "<td>
                <a href='../post.php?p_id={$id}'>View Post</a></td>";
                echo "<td>
                <a href='posts.php?source=edit_post&p_id={$id}'>Edit</a><br>
                <a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$id}'>Delete</a></td>";
                echo "</tr>";
            } ?>
    </tbody>
</table>
</form>

<?php
    if(isset($_GET['delete'])) {
       $id = $_GET['delete'];
       
       $query = "DELETE FROM posts WHERE id = {$id}";
       $delete_query = mysqli_query($connection, $query);
       
       header("Location: posts.php");
    }
?>