<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 
  echo "
  <link href='../../css/stylesheet.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../favicon.png' />";

  echo "
  <body class='special-page'>
  <div id='container'>
  
  <section id='error-number'>
  <center><div class='gembok'><img src='../../img/lock.png'></div></center>
  <h1>AKSES ILEGAL</h1>
  <p class='maaf'>Untuk mengakses modul, Anda harus login dahulu!</p><br/>
  </section>
  
  <section id='error-text'>
  <p><a class='tombol' href=../../index.php><b>LOGIN DISINI</b></a></p>
  </section>
  </div>";}

else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kata Jelek
if ($module=='katajelek' AND $act=='hapus'){
  mysqli_query($koneksi,"DELETE FROM katajelek WHERE id_jelek='$_GET[id]'");
  header('location:../../media.php?module='.$module.'&msg=delete');
}


// Hapus Terseleksi
elseif($module=='katajelek' AND $act=='hapussemua'){
	if(isset($_POST['cek'])){
	foreach($_POST['cek'] as $cek => $num){
		mysqli_query($koneksi,"DELETE FROM katajelek WHERE id_jelek=$num");
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
	} else {
  header('location:../../media.php?module='.$module.'&msg=delete');
	}
}


// Input kata jelek
elseif ($module=='katajelek' AND $act=='input'){
  mysqli_query($koneksi,"INSERT INTO katajelek(kata,username,ganti) VALUES('$_POST[kata]','$_SESSION[namauser]','$_POST[ganti]')");
  header('location:../../media.php?module='.$module.'&msg=insert');
}

// Update kata jelek
elseif ($module=='katajelek' AND $act=='update'){
  mysqli_query($koneksi,"UPDATE katajelek SET kata = '$_POST[kata]', ganti='$_POST[ganti]' WHERE id_jelek = '$_POST[id]'");
   header('location:../../media.php?module='.$module.'&msg=update');
}
}
?>