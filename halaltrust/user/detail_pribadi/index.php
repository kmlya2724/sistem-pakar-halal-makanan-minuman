<?php
session_start();
if(isset($_SESSION['login'])){
  header('Location: dash_detail_pribadi.php');
}else{
  header('Location: ../../login.php');
}