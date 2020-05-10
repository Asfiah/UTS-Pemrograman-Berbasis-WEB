<?php
// retrieve one product will be here
 // get ID of the product to be edited
$id_review = isset($_GET['id_review'])? $_GET['id_review'] : '';
 
// include database and object files
include_once 'oop/config/database.php';
include_once 'oop/objects/review.php';

 // set page header
$page_title = "Edit Review";
include_once "oop/layout_header.php";
 
// contents will be here
 echo "<div class='right-button-margin'>";
    echo "<a href='view_review.php' class='btn btn-default pull-right'>BACK</a>";
echo "</div>";
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$review = new Review($db);
 
// set ID property of product to be edited
$review->id_review = $id_review;
 
// read the details of product to be edited
$review->readOne();
 
?>
<!-- 'update product' form will be here -->
<!-- post code will be here -->
 <?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $review->ulasan = $_POST['ulasan'];
    
 
    // update the product
    if($review->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Data produk telah diperbarui.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Tidak dapat memperbarui data produk.";
        echo "</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Ulasan</td>
            <td><input type='text' name='name' value='<?php echo $review->ulasan; ?>' class='form-control' /></td>
        </tr>
 
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
// set page header
$page_title = "Update Review";
include_once "oop/layout_header.php";
 
// contents will be here
// set page footer
include_once "oop/layout_footer.php";
?>