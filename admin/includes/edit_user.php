<?php 

if(isset($_GET['edit_user'])){

$the_user_id = $_GET['edit_user'];

}


$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_users = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

}

if(isset($_POST['update_user'])){

   $username = $_POST['username'];
   $user_firstname = $_POST['user_firstname'];
   $user_lastname = $_POST['user_lastname'];
   $user_email = $_POST['user_email'];
   $user_password= $_POST['user_password'];

   $query = "SELECT randSalt FROM users";          // ENCRYPT
   $select_randSalt_query = mysqli_query($connection,$query);
   $row = mysqli_fetch_array($select_randSalt_query);
         $salt = $row['randSalt'];
         $hased_password = crypt($user_password, $salt); 

   $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_password = '{$hased_password}' WHERE user_id = {$the_user_id}";
 

$update_user_query = mysqli_query($connection, $query);
if(!$update_user_query){
   die ("Query failed" . mysqli_error($connection));
}
header("Location: users.php");
}
?>


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
   </div>

   <div class="form-group">
      <label for="username">Username</label>
      <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
   </div>


   <div class="form-group">
     <label for="user_email">Email</label>
     <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
   </div>

   <div class="form-group">
      <label for="user_password">Password</label>
      <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
   </div>


   <div>
       <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
   </div>



</form>