<?php

date_default_timezone_set('Asia/Jakarta');
$connect = mysqli_connect 
   (
    "localhost",
    "root",
    "",
    "uts"
   );
if (mysqli_connect_errno())
 {
  echo "Koneksi Gagal"
  .mysqli_connect_error();
 }
 $base_url="http://localhost/Siabadi/";
?>