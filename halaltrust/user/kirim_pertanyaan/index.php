<?php
session_start();
if(isset($_SESSION['login'])){
  header('Location: dash_kirim_pertanyaan.php');
}else{
  header('Location: ../../login.php');
}