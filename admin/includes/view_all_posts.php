<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
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
                <a href='posts.php?source=edit_post&p_id={$id}'>Edit</a><br>
                <a href='posts.php?delete={$id}'>Delete</a></td>";
                echo "</tr>";
            } ?>
    </tbody>
</table>

<?php
    if(isset($_GET['delete'])) {
       $id = $_GET['delete'];
       
       $query = "DELETE FROM posts WHERE id = {$id}";
       $delete_query = mysqli_query($connection, $query);
       
       header("Location: posts.php");
    }
?>