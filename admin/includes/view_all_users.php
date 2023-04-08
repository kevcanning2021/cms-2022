<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Change to admin</th>
            <th>Change to subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $all_users_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($all_users_query)) {
            $id = $row['id'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $image = $row['image'];
            $role = $row['role'];

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$email}</td>";
            echo "<td><img src='../images/{$image}' class='img-responsive' style='width:100px;'/></td>";
            echo "<td>{$role}</td>";
            echo "<td><a href='users.php?change_to_admin={$id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_subscriber={$id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&u_id={$id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$id}'>Delete</a></td>";
            echo "</tr>";
        } ?>
    </tbody>
</table>

<?php
if (isset($_GET['change_to_admin'])) {
    $id = $_GET['change_to_admin'];

    $query = "UPDATE users SET role = 'admin' WHERE id = {$id}";
    $change_admin_query = mysqli_query($connection, $query);

    header("Location: users.php");
}

if (isset($_GET['change_to_subscriber'])) {
    $id = $_GET['change_to_subscriber'];

    $query = "UPDATE users SET role = 'subscriber' WHERE id = {$id}";
    $change_subscriber_query = mysqli_query($connection, $query);

    header("Location: users.php");
}

if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {
            $id = $_GET['delete'];

            $query = "DELETE FROM users WHERE id = {$id}";
            $delete_query = mysqli_query($connection, $query);

            header("Location: users.php");
        }
    }
}
?>