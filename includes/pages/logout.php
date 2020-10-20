<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>


<?php

  $_SESSION['id'] = null;
  $_SESSION['name'] = null;
  $_SESSION['position'] = null;
  
  header("Location: ../index.php");
  ?>