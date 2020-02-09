<?php

if(isset($_POST['checkBoxArray'])){
   foreach($_POST['checkBoxArray'] as $checkBoxValue){
   $bulk_options = $_POST['bulk_options']; 

   switch($bulk_options){
      case 'published':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}'";
      $update_to_published_status = mysqli_query($connection, $query);
      break;

      case 'draft':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}'";
      $update_to_draft_status = mysqli_query($connection, $query);
      break;

      case 'delete':
      $query = "DELETE FROM posts WHERE post_id = '{$checkBoxValue}'";
      $update_to_delete = mysqli_query($connection, $query);
      break;

      case 'clone':
$query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}'";
$select_all_posts = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_posts)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    
$query = "INSERT INTO posts(post_title, post_author, post_category_id, post_status, post_image,post_tags, post_content, post_date) ";
$query .= "VALUES('{$post_title}', '{$post_author}', {$post_category}, '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now())";
$copy_post_query = mysqli_query($connection,$query);
if(!$copy_post_query){
    die ("Failed." . mysqli_error($connection));
}
}
break;

      case 'reset':
            $count_reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $checkBoxValue ";
            $reset_query = mysqli_query($connection,$count_reset_query);
      break;
  
  }
 }
}

?>
<form action="" method='post'>
<table class="table table-bordered table-hover">

    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;">
    <select class="form-control" name="bulk_options" id="">
         <option value="">Select Options</option>
         <option value="published">Published</option>
         <option value="draft">Draft</option>
         <option value="delete">Delete</option>
         <option value="clone">Clone</option>
         <option value="reset">Reset Views</option>
     </select>
    </div>


    <div class="col-xs-4">

    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add Posts</a>
    
    </div>

                    <thead>
                        <tr>
                            <th><input id="selectAllBoxes" type="checkbox"></th>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                            <th>Views</th>
                            <th>Link</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Reset Views</th>
                        </tr>
                    </thead>
                
                <tbody>
<?php
$query = "SELECT * FROM posts ORDER BY post_id DESC ";
$select_posts = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_Views_count = $row['post_views_count'];

    echo "<tr>";
    ?>

    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

    <?php
    echo "<td>{$post_id}</td>";
    echo "<td>{$post_author}</td>";
    echo "<td>{$post_title}</td>";

$query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
$select_categories_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_categories_id)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
}


    echo "<td>{$cat_title}</td>";






    echo "<td>{$post_status}</td>";
    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
    echo "<td>{$post_tags}</td>";
    echo "<td>{$post_comments}</td>";
    echo "<td>{$post_date}</td>";
    echo "<td>{$post_Views_count}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset views');\" href='posts.php?reset={$post_id}'>Reset Views</a></td>";
    echo "</tr>";

    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
     }
    }
 
  if(isset($_GET['reset'])){
     $the_post_id = $_GET['reset'];
     $count_query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
     $reset_query = mysqli_query($connection,$count_query);
     header("Location: posts.php");



  }


?>





     </tbody>
</table>

</form>