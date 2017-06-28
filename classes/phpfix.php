<?php
  function h() { 
    return call_user_func_array("htmlentities", func_get_args());
  }
  
?>
