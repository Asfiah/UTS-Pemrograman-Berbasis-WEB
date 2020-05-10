<?php
// include database and object files
include_once 'oop/config/database.php';
include_once 'oop/objects/review.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$review = new review($db);
// set page headers
$page_title = "Share Your Experience! Help them to find their vacation's resort";
include_once "oop/layout_header.php";
 
// contents will be here
 echo "<div class='right-button-margin'>";
    echo "<a href='view_review.php' class='btn btn-danger pull-right'>Kembali</a>";
echo "</div></br>";
 
?>
<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
 <?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $review->id_user = $_POST['id_user'];
    $review->id_reservation = $_POST['id_reservation'];
    $review->ulasan = $_POST['ulasan'];
		
    // create the product
    if($review->create()){
        echo "<div class='alert alert-success'>Review telah ditambahkan</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Tidak dapat menambahkan review.</div>";
    }
}
?>
<!-- HTML form for creating a product -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
             <div class="form-group">
                <input type="text" class="form-control hidden" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" name="id_user">
              </div>
              <div class="form-group">
                <input type="text" class="form-control hidden" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" name="id_reservation">
              </div><br><br>
              <div class="form-group">
                <label for="exampleInputEmail1">Ulasan</label>
                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ulasan"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
  </form>
<?php
// footer
include_once "oop/layout_footer.php";
?>