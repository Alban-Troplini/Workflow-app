<?php require_once('../functions/init.php'); ?>
<?php require_once('../sky/detailed_sky.php'); ?>
<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    if(!isset($_SESSION['name'])){

      header("Location: login.php");
  
    }
 ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <link href="../css/tox-progress.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap-4.5.0-dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="../css/objectives.css" rel="stylesheet"> -->
    <!-- App css -->
    
    <link href="../fullcalendar/style.css" rel="stylesheet" type="text/css" />

    

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow ">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img src="../icons/white_logo.png" width="40px">&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-outline-secondary px-md-6"><?php echo "Welcome, ".$_SESSION['name'];?></button></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" style="color: white;" href="../index.php?ins=projects.php">Back to Projects</a>
  </li>
  </ul>
<script>
  $(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("navbar-collapse in");
        if (_opened === true && !clickover.hasClass("navbar-toggle")) {
            $("button.navbar-toggle").click();
        }
    });
});
</script>
</nav>
          <?php
            
            add_objectives();
          ?>

          <?php
            
            add_notes();
          ?>

            <?php
            
            delete_objective();
            ?>

            <?php
            
            delete_notes();
            ?>

          <?php
            
            done_objective();
            ?>

            <?php
            
              undone_objective();
            ?>

    <main role="main" class="">
      <div class="row" >
          
      </div>
      <style>
        body{
          background-color: #d8e2dc;
        }

        .breadcrumb { 
  list-style: none; 
  overflow: hidden; 
  font: 22px Helvetica, Arial, Sans-Serif;
  margin: 40px;
  padding: 0;
}

.breadcrumb li a {
  color: white;
  text-decoration: none; 
  padding: 10px 20px 10px 55px;
  background: brown; /* fallback color */
  background: #f6bd60; 
  position: relative; 
  display: block;
  float: right;
}
.breadcrumb li a:after { 
  content: " "; 
  display: block; 
  width: 0; 
  height: 0;
  border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
  border-bottom: 50px solid transparent;
  border-left: 30px solid #f6bd60;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  left: 100%;
  z-index: 2; 
}   
.breadcrumb li a:before { 
  content: " "; 
  display: block; 
  width: 0; 
  height: 0;
  border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
  border-bottom: 50px solid transparent;
  border-left: 30px solid white;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  margin-left: 5px;
  left: 100%;
  z-index: 1; 
}   
.breadcrumb li:first-child a {
  padding-left: 350px;
}
.breadcrumb li:nth-child(2) a       { background:        #84a59d; padding-left: 200px;}
.breadcrumb li:nth-child(2) a:after { border-left-color: #84a59d; }
.breadcrumb li:nth-child(3) a       { background:        #f28482;padding-left: 340px; }
.breadcrumb li:nth-child(3) a:after { border-left-color: #f28482; }
.breadcrumb li a:hover { background: #c6e2e9; }
.breadcrumb li a:hover:after { border-left-color: #c6e2e9 !important; }




@media only screen and (max-width: 740px){
     .breadcrumb{
  padding-left: 150px;
}
.breadcrumb li:nth-child(2) a       { background:        #84a59d; padding-left: 70px;}
.breadcrumb li:nth-child(2) a:after { border-left-color: #84a59d; }
.breadcrumb li:nth-child(3) a       { background:        #f28482;padding-left: 150px; }
.breadcrumb li:nth-child(3) a:after { border-left-color: #f28482; }
.breadcrumb li a:hover { background: #c6e2e9; }
.breadcrumb li a:hover:after { border-left-color: #c6e2e9 !important; }
     }

     @media only screen and (max-width: 1342px){
     .breadcrumb{
          display: none;
     }
}



      </style>
        <ul class="breadcrumb">
          <li><a href="#">To Do</a></li>
          <li><a href="#">Completed</a></li>
          <li><a href="#">Notes</a></li>
        </ul>

    <div class="row m-2">
          <div class="col-md-6 col-lg-4 m-4 back">

          <form action="" id="add" method="POST">
          <!-- <h3 class="todo-1">To Do:</h3> -->
          <div class="input-group mb-3">
            <textarea type="text" form-id="add" class="form-control" name="objective" placeholder="New Task" aria-describedby="basic-addon2"></textarea>
            <button class="btn btn-light" form-id="add" type="submit" name="add_obj"><img src="../icons/add.png" alt=""></button> 
         </div>
          </form>


          <?php
              
              global $connect;

                    
            $sql = "SELECT * FROM project_objectives WHERE project_id = {$_GET['pro_id']} AND project_status = 1";

                    $result = $connect->query($sql);

                    while($rows = $result->fetch()) {
                      
                      $objectives_id      = $rows['objectives_id'];
                      $objectives         = $rows['objectives'];
                      $objectives_status  = $rows['project_status'];
                      $project_id         = $rows['project_id'];

          ?>

            <form action="" id="edit" method="POST">
            <div style="background-color: white; margin: 5px; display:flex; border-radius: 10px; padding: 5px;">
                  <p style="font-size: 1rem; flex: 2;"><?php echo "$objectives";?></p>
                  <input type="hidden" name="obj_id" value="<?php echo $objectives_id;?>">
                  <button class="btn btn-link" onclick="return confirm('Are you sure to delete this TASK?')" name="delete_obj" type="submit"><img width="20px" src="../icons/trash1.png" alt=""></button>
                  <button class="btn btn-link" name="done_obj" type="submit"><img width="20px" src="../icons/ok.png" alt=""></button>
             
            </div>
         
          </form>
                 
                    <?php } ?>
                    </div>

                    <div class="col-md-6 col-lg-3 m-2 back1">
                    <!-- <h3 class="todo">Completed:</h3> -->

                    <?php

                        global $connect;

                        $sql = "SELECT COUNT(project_id) as total FROM project_objectives WHERE project_id = {$_GET['pro_id']}";

                        $result = $connect->query($sql);

                        while($rows = $result->fetch()) {

                          $objectives_count = $rows['total'];
                        ?>
                          
                          <div class="row d-flex justify-content-around m-2">
                          <h4><img src="../icons/total-obj.png" alt="">Total: <span class="badge badge-warning"><?php echo $objectives_count;?></span></h4>
                        
                          
                            
                        <?php } ?>
                        <?php

                        global $connect;

                        $sql = "SELECT COUNT(project_id) as completed FROM project_objectives WHERE project_id = {$_GET['pro_id']} AND project_status = 0";

                        $result = $connect->query($sql);

                        while($rows = $result->fetch()) {

                          $objectives_completed = $rows['completed'];
                        ?>

                        <h5><img src="../icons/completed-obj.png" alt="">Completed: <span class="badge badge-success"><?php echo $objectives_completed;?></span></h5>
                        </div>


          <?php
              
              global $connect;

                    
            $sql = "SELECT * FROM project_objectives WHERE project_id = {$_GET['pro_id']} AND project_status = 0";

                    $result = $connect->query($sql);

                    while($rows = $result->fetch()) {
                      
                      $objectives_id      = $rows['objectives_id'];
                      $objectives         = $rows['objectives'];
                      $objectives_status  = $rows['project_status'];
                      $project_id         = $rows['project_id'];
                      $obj_name           = $rows['u_name'];
          ?>

            <form action="" id="edit" method="POST">
            <div style="background-color: white; margin: 5px; display:flex; border-radius: 10px; padding: 5px;" title="Completed by: <?php echo $obj_name;?>">
                  <p class=" text-muted" style="font-size: 0.9rem; flex: 2; text-decoration: line-through;"><?php echo "$objectives";?></p>
                  <input type="hidden" name="obj_id" value="<?php echo $objectives_id;?>">
                  <button class="btn btn-link" name="undone_obj" type="submit"><img width="20px" src="../icons/nok1.png" alt=""></button>
             
            </div>
         
          </form>

                    <?php } ?>
                    
                    </div>
                   
                    <div class="col-md-6 col-lg-4 m-3 back">

<form action="" id="add_note" method="POST">
<div class="input-group mb-3">
  <textarea type="text" form-id="add_note" class="form-control" name="notes" placeholder="Notes..." aria-describedby="basic-addon2"></textarea>
  <button class="btn btn-light" form-id="add_note" type="submit" name="add_notes"><img src="../icons/add.png" alt=""></button> 
</div>
</form>


<?php
    
    global $connect;

          
  $sql = "SELECT * FROM project_notes WHERE project_id = {$_GET['pro_id']}";

          $result = $connect->query($sql);

          while($rows = $result->fetch()) {
            
            $notes_id      = $rows['notes_id'];
            $notes         = $rows['notes'];
            $project_id    = $rows['project_id'];
            $n_name        = $rows['n_name'];
?>

  <form action="" id="edit" method="POST">
  <div style="background-color: white; margin: 5px; display:flex; border-radius: 10px; padding: 5px;" title="<?php echo $n_name;?> says:">
        <!-- <p style="font-size: 1rem; flex: 2; color: silver;"><?php echo "$n_name";?></p><br> -->
        <p style="font-size: 1rem; flex: 2; color:darkslategrey;"><?php echo "$notes";?></p>
        <input type="hidden" name="notes_id" value="<?php echo $notes_id;?>">
        <button class="btn btn-link" onclick="return confirm('Are you sure to delete this NOTE?')" name="delete_notes" type="submit"><img width="20px" src="../icons/trash1.png" alt=""></button>
  </div>

</form>
       
          <?php } ?>
          </div>
                      <?php } ?>

         
                      </div>
                      
               
                   
                      
    </main>
  </div>
</div>

    <div style="position: absolute; bottom: 5px; text-align:center; width: 100%;" >
    <h6>Alban Troplini Developer 2020</h6>
    </div>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        ToxProgress.create();
        ToxProgress.animate();
    });

</script>

<script> $('.alert').alert() </script>
<script src="../js/tox-progress.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.c../assets/dist/css/bootstrap.cssloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="js/dashboard.js"></script></body>

