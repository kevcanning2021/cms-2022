<?php
function users_online() {
    if(isset($_GET['usersonline'])) {
        global $connection;

        if(!$connection) {
            session_start();
            include "../includes/db.php";
        }

        $session = session_id();
        $time = time();
        $timeout_in_seconds = 60;
        $timeout = $time - $timeout_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }

        $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeout'");
        echo mysqli_num_rows($users_online);
    }
}

users_online();

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
                die('QUERY FAILED' . mysqli_query($connection, $insert_query));
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