<?php require_once('functions/init.php'); ?>
<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    if(!isset($_SESSION['name'])){

      header("Location: pages/login.php");
  
    }
 ?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Project Workflow</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="../bootstrap-4.5.0-dist/css/bootstrap.css" rel="stylesheet">


    <link href="fullcalendar/style.css" rel="stylesheet" type="text/css" />

  </head>
  <body>
    
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"> <img src="icons/white_logo.png" width="40px">&nbsp;&nbsp;Development</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark " type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="pages/logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <br>
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="index.php?ins=dashboard.php">
              <span data-feather="home"></span>
              Home <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=calendar.php">
              <span data-feather="shopping-cart"></span>
              Calendar
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=users.php">
              <span data-feather="shopping-cart"></span>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=client.php">
              <span data-feather="users"></span>
              Clients
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=projects.php">
              <span data-feather="file"></span>
              Projects
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=working_projects.php">
              <span data-feather="users"></span>
              Working Projects
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=testing_projects.php">
              <span data-feather="users"></span>
              Testing Projects
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?ins=completed_projects.php">
              <span data-feather="bar-chart-2"></span>
              Finished Projects
            </a>
          </li>
        </ul>
        </ul>
      </div>
    </nav>
    <?php   
if(!empty($_GET['ins'])){
$page_name_len = strlen($_GET['ins']);
$page_name = substr($page_name_len, 0, -4);
}
else {
  echo "";
}
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php if(!empty($_GET['ins'])) {echo ucfirst(substr($_GET['ins'], 0, -4));} else { echo "";} ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary px-md-6"><?php echo "Welcome, ".$_SESSION['name'];?></button>
          </div>
        </div>
      </div>
      <div id="content">

<?php   

  if(!empty($_GET['ins'])) {

    $PagesDirectory = 'pages';
    $PagesFolder = scandir($PagesDirectory, 0); 
    unset($PagesFolder[0], $PagesFolder[1]);
    $PageName = $_GET['ins'];

    if(in_array($PageName, $PagesFolder)){

    require_once($PagesDirectory.'/'.$PageName);

    }
     else {

      echo "<h2>Error. Page not found!</h2>";
    }
    
  } else {

    require_once("pages/dashboard.php");
  }


?>



</div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.c../assets/dist/css/bootstrap.cssloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="js/dashboard.js"></script></body>
</html>
