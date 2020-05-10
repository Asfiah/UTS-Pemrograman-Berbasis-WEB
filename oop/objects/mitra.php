<?php
include_once 'user.php';
class mitra extends user{
      private $conn;
    private $table_name = "user";

    public function __construct($db){
        $this->conn = $db;
    }
    public $alamat, $telepon, $nama_properti;
    public $image;
    public $timestamp;
    public function create(){
        //write query
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET fname=:fname, lname=:lname, email=:email, status=:status,
                alamat=:alamat,telepon=:telepon, image=:image, password=:password, nama_properti=:nama_properti";
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->fname=htmlspecialchars(strip_tags($this->fname));
        $this->lname=htmlspecialchars(strip_tags($this->lname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->alamat=htmlspecialchars(strip_tags($this->alamat));
        $this->telepon=htmlspecialchars(strip_tags($this->telepon));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->nama_properti=htmlspecialchars(strip_tags($this->nama_properti));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":fname", $this->fname);
        $stmt->bindParam(":lname", $this->lname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":telepon", $this->telepon);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":nama_properti", $this->nama_properti);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

 /*   public function update(){
 
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                name = :name,
	                price = :price,
	                description = :description,
	                category_id  = :category_id,
	            WHERE
	                id = :id";
	 
	    $stmt = $this->conn->prepare($query);
	 
	    // posted values
	    $this->name=htmlspecialchars(strip_tags($this->name));
	    $this->price=htmlspecialchars(strip_tags($this->price));
	    $this->description=htmlspecialchars(strip_tags($this->description));
	    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
	    $this->id=htmlspecialchars(strip_tags($this->id));

	 
	    // bind parameters
	    $stmt->bindParam(':name', $this->name);
	    $stmt->bindParam(':price', $this->price);
	    $stmt->bindParam(':description', $this->description);
	    $stmt->bindParam(':category_id', $this->category_id);


	    $stmt->bindParam(':id', $this->id);
	 
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
    } */
// delete the product
	public function delete(){
	 
	    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	     
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(1, $this->id);
	 
	    if($result = $stmt->execute()){
	        return true;
	    }else{
	        return false;
	    }
	}

    public function uploadPhoto()
    {
     
        $result_message="";
     
        // now, if image is not empty, try to upload the image
        if($this->image){
     
            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
     
            // error message is empty
            $file_upload_error_messages="";
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                    // submitted file is an image
                }else{
                    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
                }
                 
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                 
                // make sure file does not exist
                if(file_exists($target_file)){
                    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                }
                 
                // make sure submitted file is not too large, can't be larger than 1 MB
                if($_FILES['image']['size'] > (1024000)){
                    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
                }
                 
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }
                // if $file_upload_error_messages is still empty
                if(empty($file_upload_error_messages)){
                    // it means there are no errors, so try to upload the file
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        // it means photo was uploaded
                    }else{
                        $result_message.="<div class='alert alert-danger'>";
                            $result_message.="<div>Unable to upload photo.</div>";
                            $result_message.="<div>Update the record to upload photo.</div>";
                        $result_message.="</div>";
                    }
                }
                 
                // if $file_upload_error_messages is NOT empty
                else{
                    // it means there are some errors, so show them to user
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="{$file_upload_error_messages}";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
                 
            }
     
            return $result_message;
    }

}
?>