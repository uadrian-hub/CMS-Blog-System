<?php

function confirmQuery($result){     // CONFIRM ARRAY CONNECTION
global $Connection;
if(!$result) {
    die("QUERY FAILED." . mysqli_error($connection));
 }else{
     echo "QUERY SUCCESS.";
 }
}



function insert_categories(){   // ADD A CATEGORY
global $connection;
if(isset($_POST["submit"])){
    $cat_title = $_POST['cat_title'];
if($cat_title == "" || empty($cat_title)){
     echo "This field should not be empty." ;
}else{
    $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
    $create_category_query = mysqli_query($connection, $query);

if(!$create_category_query){
    die("QUERY FAILED" . mysqli_error($connection));
}else{
    echo "<h3 style='color:green'>Category Created. </h3>";
    }
   }
  }
 }


function find_all_categories(){  // SHOW ALL CATEGORIES
 global $connection;
 $query = "SELECT * FROM categories ";
 $select_categories = mysqli_query($connection, $query);
 
 while($row = mysqli_fetch_assoc($select_categories)){
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
    
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "</tr>";
  }
}



function delete_a_category(){   // DELETE CATEGORY 
  global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}



function createNewPost(){             // CREATE NEW POST 
global $connection;

if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status']; 

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    
move_uploaded_file($post_image_temp, "../images/$post_image" );

$query = "INSERT INTO posts(post_title, post_author, post_category_id, post_status, post_image,post_tags, post_content, post_date) ";
$query .= "VALUES('{$post_title}', '{$post_author}', {$post_category_id}, '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}',now())";
$create_post_query = mysqli_query($connection,$query);
$last_created_id = mysqli_insert_id($connection);
echo "<p class='bg-success'>Post Created. <a href ='../post.php?p_id={$last_created_id}'> View Post</a> or <a href='./posts.php'>Create More Posts</a>";
if(!$create_post_query){
    die ("Query Failed" . mysqli_error($connection));
}
   }
}




function createNewUser(){             // CREATE NEW USER
    global $connection;
    
    if(isset($_POST['create_user'])){
    
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username']; 
    
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
    //     $post_image_temp = $_FILES['image']['tmp_name'];
    
    //     $post_tags = $_POST['post_tags'];
    //     $post_content = $_POST['post_content'];
    //     $post_date = date('d-m-y');
        
    // move_uploaded_file($post_image_temp, "../images/$post_image" );
    
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password ) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";
    $create_user_query = mysqli_query($connection,$query);
      if(!$create_user_query){
        die ("Query Failed" . mysqli_error($connection));
    }else {
            echo "<h3 style='color:green'>User Created: </h3>" . "<a href='users.php'>View Users</a>";
    }
       }
    }
     





?>