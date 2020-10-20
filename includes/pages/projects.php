
<?php require_once('sky/projects_sky.php'); ?>
<?php require_once('functions/init.php');?>

<?php 
  add_project();
?>
<?php 
  delete_project();
  on_work_project();
  prepare_project();
?>
    
    <link href="./css/tox-progress.css" rel="stylesheet">
    <link href="./css/projects.css" rel="stylesheet">
    
    <main class="container">
    <button type="button" class="btn btn-info btn-lg float-right" data-toggle="modal" data-target=".project-modal">New</button>
<br> <br> 

<div class="modal fade project-modal" tabindex="-1" role="dialog" aria-labelledby="project-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


    <form action="" method="POST">

      <div class="modal-body">

    <div class="col-md-8 order-md-1">
      <h4 class="mb-5">New Project</h4>
        <div class="row">
          <div class="col-md-9 mb-3">
            <label for="projectName">Project Name</label>
            <input type="text" name="project_name" class="form-control" >
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="color">Project Color</label>
          <select name="project_color" class="form-control">
            <option value="#f9c6c9">Nude</option>
            <option value="#dbcdf0">Purple</option>
            <option value="#c6def1">Water</option>
            <option value="#f7d9c4">Peach</option>
            <option value="#d2d2cf">Silver</option>
            <option value="#b7e4c7">Green</option>
            <option value="#ee6055">Red</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="stauts">Project Status</label>
          <select name="project_status" class="form-control">
            <option value="Preparing">Preparing</option>
            <option value="Paused">On Hold</option>
            <option value="Working">In Progress</option>
            <option value="Testing">Testing</option>
            <option value="Completed">Completed</option>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
          <label for="startdate">Start Date</label>
          <input type="date" name="project_start_date" value="YYYY-MM-DD" class="form-control" >
        </div>

          <div class="col-md-6 mb-3">
          <label for="enddate">End Date</label>
          <input type="date" name="project_end_date" value="YYYY-MM-DD" class="form-control" >
          </div>
        </div>
    </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
        <button type="submit" name="add_project" class="btn btn-info btn-lg">Save</button>
      </div>
      </form>
    </div>
  </div>   
</div>
<br>
<div class="row">
     
  </div>


<!-- start container  -->
<div class="container">
<?php

    $per_page = 5;

  if(isset($_GET['ul'])){

   

    $page = $_GET['ul'];
  } else {
    $page = "";
  }

  if($page == "" || $page == 1){

    $page_1 = 0;
  } else {
    $page_1 = ($page * $per_page) - $per_page;
  }
?>
<?php

      global $connect;
  //pagination!


      $project_query_count = "SELECT COUNT(*) as pro_count FROM proejcts";
      $find_count = $connect->query($project_query_count);
      while($rows_project_count = $find_count->fetch()){

        $count_projects = $rows_project_count['pro_count'];
      }
      $count_projects = ceil($count_projects / $per_page);

      //end of pagination

    $sql_all = "SELECT * FROM proejcts ORDER BY project_id DESC LIMIT {$page_1}, {$per_page}";

  // show all projects
      $result_all = $connect->query($sql_all);

      while($rows_all = $result_all->fetch()) {

        $project_id      = $rows_all['project_id'];
        $project_status  = $rows_all['project_status'];
        $project_name    = $rows_all['project_name'];
        $project_start   = $rows_all['project_start_date'];
        $project_end     = $rows_all['project_end_date'];    

  // get diference of date's 
        $day_sql = "SELECT TIMESTAMPDIFF(DAY, project_start_date, project_end_date) AS days FROM proejcts WHERE project_id = {$project_id}";

        $result_days = $connect->query($day_sql);

        while($day = $result_days->fetch()) {
          
          $project_days = $day['days'];
        }
      
  //difference of date's       
        $remain_day_sql = "SELECT TIMESTAMPDIFF(DAY, now(), project_end_date) AS days_remain FROM proejcts WHERE project_id = {$project_id}";
                      
        $result_days_remain = $connect->query($remain_day_sql);

        while($day_remain = $result_days_remain->fetch()) {
       
          $project_days_remain = $day_remain['days_remain'];
  
          
        }

  //count objectives from objectives!
          $sql_count = "SELECT COUNT(project_id) as total FROM project_objectives WHERE project_id = {$project_id}";

          $result_count = $connect->query($sql_count);
  
          while($rows_count = $result_count->fetch()) {
  
            $objectives_count = $rows_count['total'];
          }

  //count completed objectives from objectives db!
        $sql_count_completed = "SELECT COUNT(project_id) as completed FROM project_objectives WHERE project_id = {$project_id} AND project_status = 0";

        $result_count_completed = $connect->query($sql_count_completed);

        while($rows_count_completed = $result_count_completed->fetch()) {

          $objectives_completed = $rows_count_completed['completed'];
        }
        ?>

        <?php 
        if($objectives_count != 0 && $objectives_completed != 0){
        $persent = round(($objectives_completed /$objectives_count) * 100);
        }
        else {
        $persent = 0;
        }
?>

    <!-- start of row -->
    <div class="row ">
       <div class="col-sm-2">
        <h2><?php echo  $project_name; ?></h2>
        <p><?php echo  $project_status;?></p>
        <p><a class="btn btn-warning" href="pages/detailed.php?pro_id=<?php echo  $project_id; ?>&name=<?php echo  $project_name; ?>" role="button">View details &raquo;</a></p> 
       </div>
       
    <div class="col-sm-4">
                <div class="row d-flex justify-content-center">
                <div class="tox-progress" data-size="150" data-thickness="15" data-color="lime" data-background="#c1e1e3" data-progress="<?php echo $persent;?>" data-speed="1500">
                  <div class="tox-progress-content todo" data-vcenter="true">
                  <h2> &nbsp;	&nbsp;&nbsp; <?php echo $persent ."%"; ?></h2>
                  </div>
                  </div>
                </div>
                
           </div>
      <div class="col-md-6 row">
           <div class="col-sm">
           <h5 class="text-muted">Total Tasks:<?php echo "<h3 class='text-info'>&nbsp;&nbsp;&raquo;&nbsp;{$objectives_count}</h3>";?></h5>
           <form action="" method="POST">
          <input type="hidden" name="project_id" value="<?php echo $project_id;?>">
          <button class="btn btn-info float-right" name="to_prepare" type="submit">Preparing</button>
          </form>  
          </div>
           <div class="col-sm">
           <h5 class="text-muted">Avaible days: <?php echo "<h3 class='text-success'>&nbsp;&nbsp;&raquo;&nbsp;{$project_days}</h3>";?></h5>
          <form action="" method="POST">
          <input type="hidden" name="project_id" value="<?php echo $project_id;?>">
          <button class="btn btn-secondary float-right" name="on_work" type="submit">On Work</button>
          </form> 
          </div>
           <div class="col-sm">
           <h5 class="text-muted">Remaining days: <?php
            if($project_days_remain < 1) {
              $neg_days = abs($project_days_remain);
           echo "<h3 class='text-danger'>&nbsp;Out of days {$neg_days}</h3>"; }
           else {
            echo "<h3 class='text-primary'>&nbsp;&nbsp;&raquo;&nbsp;{$project_days_remain}</h3>";
           }
           ?></h5>
          
           <form action="" method="POST">
                  <input type="hidden" name="project_id" value="<?php echo $project_id;?>">
                  <button class="btn btn-danger float-right" onclick="return confirm('Are you sure to DELETE this project?')" name="delete_project" type="submit">Delete</button>
          </form>

          </div>
      </div>
    </div>  <!--     end of row          -->
    <br>
    <hr>
              <?php }  ?>
              <br>
              <div class="row justify-content-center">

        <ul class="pagination ">
        <?php

        for($i=1; $i <= $count_projects; $i++ ){

          if($i == $page){

            echo "<li class='page-item'><a class='active_link page-link' href='index.php?ins=projects.php&ul={$i}'>{$i}</a></li>";

          } else {

           echo "<li class='page-item'><a class='page-link' href='index.php?ins=projects.php&ul={$i}'>{$i}</a></li>";
        }
      }
        ?>
        </ul>
        </div>

    </div> <!-- end of container -->
    </main>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        ToxProgress.create();
        ToxProgress.animate();
    });
</script>

<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/script.js"></script>

<script src="js/tox-progress.js"></script>

<script src="js/bootstrap.min.js"></script>