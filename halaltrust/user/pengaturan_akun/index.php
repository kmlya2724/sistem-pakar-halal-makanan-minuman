<?php
session_start();
if(isset($_SESSION['login'])){
  header('Location: dash_pengaturan_akun.php');
}else{
  header('Location: ../../login.php');
}