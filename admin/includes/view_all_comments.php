<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Unapprove</th>
            <th>Approve</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $all_comments_query = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($all_comments_query)) { 
                $id = $row['id']; 
                $post_id = $row['post_id']; 
                $date = $row['date']; 
                $author = $row['author']; 
                $email = $row['email']; 
                $content = $row['content']; 
                $status = $row['status']; 

                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$date}</td>";

                // $query = "SELECT * FROM categories WHERE id = {$category_id}";
                // $edit_query = mysqli_query($connection, $query);
        
                // while($row = mysqli_fetch_assoc($edit_query)) { 
                //     $title = $row['title']; 

                    echo "<td>{$author}</td>";
                // }

                echo "<td>{$email}</td>";                
                echo "<td>{$content}</td>";
                echo "<td>{$status}</td>";

                $query = "SELECT * FROM posts WHERE id = {$post_id}";
                $post_id_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($post_id_query)) {
                    $post_id = $row['id'];
                    $title = $row['title'];

                    echo "<td><a href='/post.php?p_id={$post_id}'>{$title}</a></td>";
                }

                echo "<td><a href='comments.php?unapprove={$id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?approve={$id}'>Approve</a></td>";
                echo "<td><a href='comments.php?delete={$id}'>Delete</a></td>";
                echo "</tr>";
            } ?>
    </tbody>
</table>

<?php
if(isset($_GET['approve'])) {
    $id = $_GET['approve'];
    
    $query = "UPDATE comments SET status = 'approved' WHERE id = {$id}";
    $approve_query = mysqli_query($connection, $query);
    
    header("Location: comments.php");
 }

if(isset($_GET['unapprove'])) {
    $id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET status = 'unapproved' WHERE id = {$id}";
    $unapprove_query = mysqli_query($connection, $query);
    
    header("Location: comments.php");
 }

    if(isset($_GET['delete'])) {
       $id = $_GET['delete'];
       
       $query = "DELETE FROM comments WHERE id = {$id}";
       $delete_query = mysqli_query($connection, $query);
       
       header("Location: comments.php");
    }
?>