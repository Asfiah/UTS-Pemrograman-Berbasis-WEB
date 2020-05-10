<?php
// include database and object files
include_once 'oop/config/database.php';
include_once 'oop/objects/room_review.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$room_review = new room_review($db);
// set page headers
$page_title = "Share Your Experience! Help them to find where to stay";
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
    $room_review->id_user = $_POST['id_user'];
    $room_review->id_reservation = $_POST['id_reservation'];
    $room_review->ulasan = $_POST['ulasan'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$room_review->image = $image;
 	// try to upload the submitted file
	// uploadPhoto() method will return an error message, if any.
		echo $room_review->uploadPhoto();
		
    // create the product
    if($room_review->create()){
        echo "<div class='alert alert-success'>Ulasan kamar telah ditambahkan.</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Tidak dapat menambahkan ulasan.</div>";
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
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Ulasan</label>
                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ulasan"></textarea>

              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Foto Profile</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                  </div>
            </div>
            <br/>

              <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// footer
include_once "oop/layout_footer.php";
?>