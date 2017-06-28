<?php
  require 'classes/db.php';
  require 'classes/phpfix.php';
  require 'classes/user.php';
  if (isset($_COOKIE['auth'])){
    $user = User::getuserfromcookie($_COOKIE['auth']);
    if (!isset($user)) {
      header("Location: /login.php");
      die();
    }
  } else {
    header("Location: /login.php");
    die();
  }
  if(isset($_POST["submit"])) {
    $error = User::addfile($user);
  }
  require "header.php";
?>

<div class="row">
  <div class="col-lg-12">
      <?php if (isset($error)) { ?>
          <span class="text text-danger"><b><?php echo $error; ?></b></span>
      <?php } ?>
    <h1>Hi <?php echo h($user); ?>,</h1>
    <h3>Your files</h3>
      <ul>
        <?php foreach (User::getfiles($user) as $file) { ?>
          <li><a href="/files/<?php echo h($user); ?>/<?php echo h($file); ?>"><?php echo h($file); ?> </a></li>
        <?php } ?> 
      </ul>
    <h3>Upload (only PDF)</h3>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload your PDF" name="submit">
      </form>
  </div>
</div>



<?php


  require "footer.php";
?>

