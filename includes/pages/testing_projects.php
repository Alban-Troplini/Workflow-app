
<?php require_once('sky/projects_sky.php'); ?>
<?php require_once('functions/init.php');?>

<?php 
  approve_project();
?>
<?php 
  back_work_project();
?>


    <link href="./css/tox-progress.css" rel="stylesheet">
    <link href="./css/projects.css" rel="stylesheet">
    
    <main class="container">

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


      $project_query_count = "SELECT COUNT(*) as pro_count FROM proejcts WHERE project_status='Testing'";
      $find_count = $connect->query($project_query_count);
      while($rows_project_count = $find_count->fetch()){

        $count_projects = $rows_project_count['pro_count'];
      }
      $count_projects = ceil($count_projects / $per_page);

      //end of pagination

    $sql_testing = "SELECT * FROM proejcts WHERE";
    $sql_testing .= " project_status='Testing'";
    $sql_testing .= " ORDER BY project_id DESC LIMIT {$page_1}, {$per_page}";

  // show all projects
      $result_all = $connect->query($sql_testing);

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
           </div>
           <div class="col-sm">
           <h5 class="text-muted">Avaible days: <?php echo "<h3 class='text-success'>&nbsp;&nbsp;&raquo;&nbsp;{$project_days}</h3>";?></h5>
           <form action="" method="POST">
                  <input type="hidden" name="project_id" value="<?php echo $project_id;?>">
                  <button class="btn btn-danger float-right" name="working_project" type="submit">To Work</button>
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
                  <button class="btn btn-success float-right" name="approve_project" type="submit">Approve</button>
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

            echo "<li class='page-item'><a class='active_link page-link' href='index.php?ins=rtesting_projects.php&ul={$i}'>{$i}</a></li>";

          } else {

           echo "<li class='page-item'><a class='page-link' href='index.php?ins=testing_projects.php&ul={$i}'>{$i}</a></li>";
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