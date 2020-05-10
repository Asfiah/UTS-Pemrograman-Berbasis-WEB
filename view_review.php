<?php
// core.php holds pagination variables
include_once 'oop/config/core.php';
 
// include database and object files
include_once 'oop/config/database.php';
include_once 'oop/objects/review.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$review = new Review($db);
 
$page_title = "List review";
include_once "oop/layout_header.php";
 
// query products
$stmt = $review->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "index.php?";
 
// count total rows - used for pagination
$total_rows=$review->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "list_review.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "oop/layout_footer.php";
?>
