<?php
    if(isset($_POST['create_user'])) {
        $username = escape($_POST['username']);
        $firstname = escape($_POST['firstname']);
        $lastname = escape($_POST['lastname']);
        $email = escape($_POST['email']);
        $password = escape($_POST['password']);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $role = $_POST['role'];

        move_uploaded_file($image_tmp, "../images/$image");

        $query = "INSERT INTO users(username,firstname,lastname,email,image,role,password)";
        $query .= "VALUES ('{$username}','{$firstname}', '{$lastname}','{$email}','{$image}','{$role}','{$password}')";
        
        $create_user = mysqli_query($connection, $query);

        confirm_query($create_user);

        $id = mysqli_insert_id($connection);

        echo "User created successfully: <a href='users.php?u_id={$id}'>View User</a><br><br>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="" class="form-group form-control">
            <option value="subscriber">Select a option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>
</form>