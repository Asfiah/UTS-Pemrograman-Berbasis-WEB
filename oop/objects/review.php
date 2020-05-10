<?php

class Review{
	public $id_review, $ulasan,$id_user;
	private $conn;
    private $table_name = "review";

    public function __construct($db){
        $this->conn = $db;
    }
    public $timestamp;
	    function create(){
        //write query
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET id_user=:id_user, ulasan=:ulasan";
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->id_user=htmlspecialchars(strip_tags($this->id_user));
        $this->ulasan=htmlspecialchars(strip_tags($this->ulasan)); 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->bindParam(":ulasan", $this->ulasan);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
     public function countAll(){
 
    $query = "SELECT id_review FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
    }
     function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                id_review, ulasan
            FROM
                " . $this->table_name . "
            ORDER BY
                ulasan ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}


    public function update(){
 
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                id_user = :id_user,
                    ulasan = :ulasan
	            WHERE
	                idreview = :id_review";
	 
	    $stmt = $this->conn->prepare($query);
	 
	    // posted values
	    $this->ulasan=htmlspecialchars(strip_tags($this->ulasan));

	 
	    // bind parameters
	    $stmt->bindParam(':ulasan', $this->ulasan);


	    $stmt->bindParam(':id', $this->id);
	 
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
    }
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

}

?>