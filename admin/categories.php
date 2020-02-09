<?php include "includes/admin_header.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                                Add/Edit/Remove Categories,
                            <small><?php echo $_SESSION['username']; ?>.</small>
                        </h1>
                <div class="col-xs-6">

<?php insert_categories(); ?>   <!-- Insert Category QUERY -->

<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Add Category</label>
         <input type="text" class="form-control" name="cat_title">
     </div>

     <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
     </div>
</form>

<?php 
if(isset($_GET['edit'])){           // UPDATE EXISTING DATA QUERY   
    $cat_id = $_GET['edit'];
    include "includes/update_categories.php";
}
?>

 </div><!-- Add Category Form-->

 <div class="col-xs-6">
    <table class="table table-bordered table-hover">
       <thead>
         <tr>
            <th>Id</th>
            <th>Category Title</th>
         </tr>
       </thead>
 <tbody>
<?php  find_all_categories(); // FIND ALL CATEGORIES QUERY  ?>  
<?php delete_a_category() // DELETE QUERY ?>
                      </tbody>
                  </table>


                </div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>