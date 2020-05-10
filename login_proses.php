<?php
session_start();

include'oop/config/koneksi.php';

$username=@$_POST['username'];
$password=@$_POST['password'];

$login =mysqli_query($connect,"select * from user where email='$username' and password='$password'");
$cek =mysqli_num_rows($login);

if($cek>0){
	$data = mysqli_fetch_assoc($login);
	if($data['status']=="mitra"){
		$_SESSION['email']=$data['email'];
		$_SESSION['status']="mitra";
		echo"<script>alert('Berhasil login')</script>";
		header("location:mitramain.php");
	}elseif($data['status']=="member"){
		$_SESSION['username']=$data['email'];
		$_SESSION['status']="member";
		echo"<script>alert('Berhasil login')</script>";
		header("location:main_member.php");
	}
		
}else{
		echo "<script>alert('".$username." - ".$password."'tidak sesuai!');
				window.location.href='index.html';</script>";}
?>
<meta http-equiv="refresh" content="3,URL=index.html">