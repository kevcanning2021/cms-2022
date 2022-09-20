<?php include "db.php"; 
session_start();
?>

<?php
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = mysqli_query($connection, $query);

        if(!$select_user_query) {
            die('QUERY FAILED: ' . mysqli_error($connection));
        }
        
        while($row = mysqli_fetch_array($select_user_query)) {
            $db_user_id = $row['id'];
            $db_user_name = $row['username'];
            $db_first_name = $row['firstname'];
            $db_last_name = $row['lastname'];
            $db_password = $row['password'];
            $db_role = $row['role'];
        }

        if($username === $db_user_name && $password === $db_password) {
                 $_SESSION['username'] = $db_user_name;
            $_SESSION['firstname'] = $db_first_name;
            $_SESSION['lastname'] = $db_last_name;
            $_SESSION['role'] = $db_role;

            header("Location: ../admin");
        } else {
            header("Location: ../index.php");
        }
    }
?>
