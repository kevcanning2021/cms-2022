<?php include "includes/admin_header.php"; ?>
<?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_user_query)) {
            $id = $row['id']; 
            $username = $row['username']; 
            $firstname = $row['firstname']; 
            $lastname = $row['lastname']; 
            $password = $row['password']; 
            $email = $row['email']; 
            $role = $row['role']; 
        }

        if(isset($_POST['update_profile'])) {
            $username = $_POST['username']; 
            $firstname = $_POST['firstname']; 
            $lastname = $_POST['lastname']; 
            $email = $_POST['email']; 
            $password = $_POST['password']; 
            $role = $_POST['role']; 

            $query = "UPDATE users SET ";
            $query .= "username = '{$username}', ";
            $query .= "firstname = '{$firstname}', ";
            $query .= "lastname = '{$lastname}', ";
            $query .= "email = '{$email}', ";
            $query .= "password = '{$password}', ";
            $query .= "role = '{$role}' ";
            $query .= "WHERE username = '{$username}'";

            $update_query = mysqli_query($connection, $query);

            confirm_query($update_query);
        }
    }
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to our admin dashboard
                        <small>Author</small>
                    </h1>
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
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
        <!-- /#wrapper -->
        <?php include "includes/admin_footer.php"; ?>