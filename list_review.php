<?php
// search form
 
// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='add_review.php' class='btn btn-primary mr-2'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add site's review";
    echo "</a>";
    echo "<a href='add_review_room.php' class='btn btn-primary ml-2'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add room's review";
    echo "</a>";
    echo "<a href='main_member.php' class='btn btn-danger pull-right'>";
        echo "Back";
    echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Ulasan</th>";
            echo "<th>Aksi</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$ulasan}</td>";
 
                echo "<td>";
 
                    // read product button
                    echo "<a href='read_one.php?id_review={$id_review}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> View";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_review.php?id_review={$id_review}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id_review='{$id_review}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once 'oop/paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>Tidak ada produk.</div>";
}
?>