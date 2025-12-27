<?php
session_start();
if(isset($_SESSION['login'])){
  header('Location: dash_list_haram.php');
}else{
  header('Location: ../../login.php');
}