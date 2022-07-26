<?php
function insert_categories() {
    global $connection;

    if(isset($_POST['submit'])) {
        $title = $_POST['title'];

        if($title == "" || empty($title)) {
            echo " This field should not be empty.";
        } else {
            $query = "INSERT INTO categories(title)";
            $query .= "VALUE ('{$title}')";

            $insert_query = mysqli_query($connection, $query);

            if(!$insert_query) {
                die('QUERY FAILED' . mysqli_query($connection));
            }
        }
    }
}

function find_all_categories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $insert_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($insert_query)) { 
        $id = $row['id']; 
        $title = $row['title']; 
        
        echo "<tr></tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$title}</td>";
        echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>";
        echo "</tr>";
    } 
}

function delete_categories() {
    global $connection;

    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function confirm_query($result) {
    global $connection;
    
    if(!$result) {
        die('QUERY FAILED: ' . mysqli_error($connection));
    }
}
?>