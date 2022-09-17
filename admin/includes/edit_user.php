<?php
if(isset($_GET['u_id'])) {
    $id = $_GET['u_id'];
}
                $query = "SELECT * FROM users WHERE id={$id}";
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
                    $username = $_POST['username']; 
                    $firstname = $_POST['firstname']; 
                    $lastname = $_POST['lastname']; 
                    $email = $_POST['email']; 
                    $password = $_POST['password']; 
                    $role = $_POST['role']; 

                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];

                    move_uploaded_file($image_tmp, "../images/$image");

                    if(empty($image)) {
                        $query = "SELECT * FROM users WHERE id = '{$id}'";

                        $image_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($image_query)) {
                            $image = $row['image'];
                        }
                    }

                    $query = "UPDATE users SET ";
                    $query .= "username = '{$username}', ";
                    $query .= "firstname = '{$firstname}', ";
                    $query .= "lastname = '{$lastname}', ";
                    $query .= "email = '{$email}', ";
                    $query .= "password = '{$password}', ";
                    $query .= "role = '{$role}', ";
                    $query .= "image = '{$image}' ";
                    $query .= "WHERE id = '{$id}'";

                    $update_query = mysqli_query($connection, $query);

                    confirm_query($update_query);
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
        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <img src="../images/<?php echo $image; ?>" alt="">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="" class="form-group form-control">
            <?php if($role == 'admin'){
                echo '<option value="subscriber">Subscriber</option>';
            } else {
                echo '<option value="admin">Admin</option>';
            } ?>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>