<?php
  $site = "PentesterLab &rarrow;";
  require "classes/user.php";
  User::logout();
  header("Location: /login.php");
  die();
?>


