<?php include "includes/admin_header.php"; ?>
<?php
if(isset($_SESSION['username'])){

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '{$username}'";
$edit_user_profile = mysqli_query($connection, $query);

while($row = mysqli_fetch_array($edit_user_profile)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];


}
if(isset($_POST['update_user_profile'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password= $_POST['user_password'];
 
    $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE user_id = '{$user_id}'";
  
    $update_profile = mysqli_query($connection, $query);
if(!$update_profile){
    die("Query Failed" . mysqli_error($connection));
}
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
                        Your Profile,
                        <small><?php echo $_SESSION['username']; ?>.</small>
                    </h1>

                
                    <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
   <label for="user_firstname">Firstname</label>
   <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
   <label for="user_lastname">Lastname</label>
   <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
</div>


<div class="form-group">
   <label for="username">Username</label>
   <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
</div>

<!-- <div class="form-group">
   <select name="user_role" id="">
   <option value=""><?php echo $user_role; ?></option>
   <?php

    if($user_role == 'admin'){
      echo "<option value='subscriber'>subscriber</option>";
    }else {
      echo "<option value='admin'>admin</option>";
    }

   ?>
   </select>
   </div> -->

<div class="form-group">
  <label for="user_email">Email</label>
  <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
</div>

<div class="form-group">
   <label for="user_password">Password</label>
   <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
</div>


<div>
    <input class="btn btn-primary" type="submit" name="update_user_profile" value="Update Profile">
</div>



</form>



                
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>