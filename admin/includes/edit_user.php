<?php
if(isset($_GET['u_id'])) {
    $id = $_GET['u_id'];
} else {
    header("Location: index.php");
} 
                $query = "SELECT * FROM users WHERE id = {$id}";
                $query_by_id = mysqli_query($connection, $query);

                confirm_query($query_by_id);
            
                while($row = mysqli_fetch_assoc($query_by_id)) { 
                    $id = $row['id']; 
                    $username = $row['username']; 
                    $firstname = $row['firstname']; 
                    $lastname = $row['lastname']; 
                    $email = $row['email']; 
                    $password = $row['password']; 
                    $role = $row['role']; 
                    $image = $row['image'];
                }

                if(isset($_POST['edit_user'])) {
                    $username = escape($_POST['username']); 
                    $firstname = escape($_POST['firstname']); 
                    $lastname = escape($_POST['lastname']); 
                    $email = escape($_POST['email']); 
                    $password = escape($_POST['password']); 
                    $role = escape($_POST['role']); 

                    if(!empty($password)) {
                        $get_user = mysqli_query($connection, $query);

                        confirm_query($get_user);

                        $row = mysqli_fetch_array($get_user);

                        $db_password = $row['password'];
                    }

                        if($db_password!= $password) {
                            $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                        }

                        $query = "UPDATE users SET ";
                        $query .= "username = '{$username}', ";
                        $query .= "firstname = '{$firstname}', ";
                        $query .= "lastname = '{$lastname}', ";
                        $query .= "email = '{$email}', ";
                        $query .= "password = '{$hashed_password}', ";
                        $query .= "role = '{$role}', ";
                        $query .= "image = '{$image}' ";
                        $query .= "WHERE id = '{$id}'";

                        $update_query = mysqli_query($connection, $query);
                }            
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <img src="../images/<?php echo $image; ?>" alt="">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>