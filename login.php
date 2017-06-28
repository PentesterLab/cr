<?php
  require 'classes/db.php';
  require 'classes/phpfix.php';
  require 'classes/user.php';

  if ((isset($_POST['username']) and isset($_POST['password']))){
    if (User::login($_POST['username'], $_POST['password'])){
      setcookie("auth", User::createcookie($_POST['username'], $_POST['password']));
      header( 'Location: /index.php' ) ;
      die();
    } else {
      $error = "Invalid credentials";
    }
  }
  require "header.php";
?>

<div class="row">
  <div class="col-lg-12">
    <h1>Log in</h1>
  </div>
  <div class="col-lg-8 col-offset-1">
      <?php if (isset($error)) { ?>
          <span class="text text-danger"><b><?php echo $error; ?></b></span>
      <?php } ?>

    <form action="/login.php" method="POST" class="form-horizontal">
      <div class="form-group">
        <label for="name">Username:</label>
        <input type="text" name="username"  class="form-control"  autofocus="true">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password"  class="form-control"  >
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="rememberme"> Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-default">Log in</button>
    </form>
  </div>
</div>



<?php


  require "footer.php";
?>

