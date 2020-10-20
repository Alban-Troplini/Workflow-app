<?php require_once('../functions/init.php'); ?>
<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>


<?php
if (isset($_POST['login'])) {

  global $connect;

  $username = $_POST['username'];
  $password = $_POST['password'];

  
  $sql = "SELECT * FROM workers WHERE workers_firstname = '{$username}'";

  $result_pass = $connect->query($sql);

  if(!$result_pass) {

    die("Query Failed" );
  }


  while ($rows = $result_pass->fetch()) {

        $log_id        = $rows['workers_id'];
        $log_Firstname = $rows['workers_firstname'];
        $log_Lastname  = $rows['workers_lastname'];
        $log_Password  = $rows['workers_password'];
        $log_Position  = $rows['workers_position'];
  }


if($username !== $log_Firstname && $password !== $log_Password){

  header("Location: login.php");

}  else {

  $_SESSION['id'] = $log_id;
  $_SESSION['name'] = $log_Firstname;
  $_SESSION['position'] = $log_Position;

  header("Location: ../index.php");

 
}
}



?>
    

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap-4.5.0-dist/css/bootstrap.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center" style="background-color: #4a4e69;">
        
    <form action="" method="POST" class="form-signin">

          <img src="../icons/white_logo.png" width="150px">
        

  <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>

  <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>

  <input type="password" name="password" class="form-control" placeholder="Password" required>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>

  </div>
  <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>

  <p class="mt-5 mb-3 text-muted">&copy; Alban Troplini 2020</p>
</form>


</body>

