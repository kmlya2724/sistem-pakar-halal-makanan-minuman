<?php
session_start();
if(isset($_SESSION['login'])){
  header('Location: dash_cek_produk.php');
}else{
  header('Location: ../../login.php');
}