<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>
<?php require_once('functions/init.php');
      require_once('sky/detailed_sky.php');

add_notes_task();
delete_task();
done_task();
undone_task();


?>

<?php
function get_Totals($column, $status) {

  global $connect;

  $sql_count = "SELECT COUNT(*) as '{$column}' FROM proejcts WHERE project_status='{$status}'";
  $project_count = $sql_count;
  $find_count_preparing = $connect->query($project_count);
  while($rows_project_count = $find_count_preparing->fetch()){

    $count_projects = $rows_project_count[$column];
  }
  return $count_projects;
}

 $preparing_project_count = get_Totals("pro_count_preparing", "Preparing");

 $paused_project_count = get_Totals("pro_count_paused", "Paused");

 $working_project_count = get_Totals("pro_count_working", "Working");

 $testing_project_count = get_Totals("pro_count_testing", "Testing");

 $completed_project_count = get_Totals("pro_count_completed", "Completed");

 $tot_pro_count = $preparing_project_count + $paused_project_count + $working_project_count + $testing_project_count + $completed_project_count;



?>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
    <link href="./css/tox-progress.css" rel="stylesheet">

    <!--calendar css-->
    <link href="./fullcalendar/packages/core/main.css" rel="stylesheet" />
    <link href="./fullcalendar/packages/daygrid/main.css" rel="stylesheet" />
    <link href="./fullcalendar/packages/bootstrap/main.css" rel="stylesheet" />
    <link href="./fullcalendar/packages/timegrid/main.css" rel="stylesheet" />
    <link href="./fullcalendar/packages/list/main.css" rel="stylesheet" />

    <!-- App css -->
    <link href="./fullcalendar/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./fullcalendar/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="./fullcalendar/style.css" rel="stylesheet" type="text/css" />
      
        <!-- Bootstrap core CSS -->
    <link href="../../bootstrap-4.5.0-dist/css/bootstrap.css" rel="stylesheet">

      <div id="content">

      <?php 

      global $connect;

      $sql_count_users = "SELECT COUNT(workers_id) as total_users FROM workers";

      $result_count_users = $connect->query($sql_count_users);

      while($rows_count_users = $result_count_users->fetch()) {

        $count_users = $rows_count_users['total_users'];
      }
      ?>
<div class="row mb-3 d-flex justify-content-around">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <h6 class="text-uppercase">Users</h6>
                            <h1 class="display-4"><?php echo $count_users; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <h6 class="text-uppercase">Projects</h6>
                            <h1 class="display-4"><?php echo $tot_pro_count; ?></h1>
                        </div>
                    </div>
                </div>
               
                <?php 

                  global $connect;

                  $sql_count_task = "SELECT COUNT(notes_id) as total_task FROM project_notes WHERE notes_st=1";

                  $result_count_task = $connect->query($sql_count_task);

                  while($rows_count_task = $result_count_task->fetch()) {

                    $count_task = $rows_count_task['total_task'];
                  }
                  ?>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-warning">
                            <h6 class="text-uppercase">Tasks</h6>
                            <h1 class="display-4"><?php echo $count_task; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-dark h-100">
                        <div class="card-body bg-secondary">
                            <h6 class="text-uppercase">Time</h6>
                            <h1 class="display-6" id="time"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->
                    <script>
                      function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

(function () {
  function checkTime(i) {
      return (i < 10) ? "0" + i : i;
  }

  function startTime() {
      var today = new Date(),
          h = checkTime(today.getHours()),
          m = checkTime(today.getMinutes()),
          s = checkTime(today.getSeconds());
      document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function () {
          startTime()
      }, 500);
  }
  startTime();
})();
                    </script>

            <!-- admin tasks -->
            <div class="row d-flex justify-content-between">
        <div class="col-md-7">
            <div id="columnchart_material" style="width: 700px; height: 500px; overflow-x: auto;"></div>
          </div>
          <div class="col-sm-4" style="height: 500px; overflow-y: auto; background-color: #e9ecef; padding: 7px;">
          <form action="" id="add" method="POST">
          <!-- <h3 class="todo-1">To Do:</h3> -->
          <div class="input-group mb-3">
            <textarea type="text" form-id="add" style="font-size: 1.1rem;" class="form-control" name="task" placeholder="To Do:" aria-describedby="basic-addon2"></textarea>
            <button class="btn btn-light" form-id="add" type="submit" name="add_task_1"><img src="./icons/add.png" alt=""></button> 
         </div>

          </form>

          <?php
    
    global $connect;

          
  $sql_task_1 = "SELECT * FROM project_notes WHERE project_id = 1 AND notes_st = 1";

          $result_task_1 = $connect->query($sql_task_1);

          while($rows_task_1 = $result_task_1->fetch()) {
            
            $notes_id      = $rows_task_1['notes_id'];
            $notes         = $rows_task_1['notes'];
            $project_id    = $rows_task_1['project_id'];
            $n_name        = $rows_task_1['n_name'];
            $notes_st      = $rows_task_1['notes_st'];
?>

          <form action="" id="edit" method="POST">
            <div style="background-color: white; margin: 5px; display:flex; border-radius: 10px; padding: 5px;">
                  <p style="font-size: 1.2rem; flex: 2;"><?php echo $notes;?></p>
                  <input type="hidden" name="notes_id" value="<?php echo $notes_id;?>">
                  <button class="btn btn-link" onclick="return confirm('Are you sure to delete this TASK?')" name="delete_task" type="submit"><img width="20px" src="./icons/trash1.png" alt=""></button>
                  <button class="btn btn-link" name="done_task" type="submit"><img width="20px" src="./icons/ok.png" alt=""></button>
                  </div>
         
          </form>

          <?php } ?>


          <?php
    
    global $connect;

          
  $sql_task_2 = "SELECT * FROM project_notes WHERE project_id = 1 AND notes_st = 2";

          $result_task_2 = $connect->query($sql_task_2);

          while($rows_task_2 = $result_task_2->fetch()) {
            
            $notes_id      = $rows_task_2['notes_id'];
            $notes         = $rows_task_2['notes'];
            $project_id    = $rows_task_2['project_id'];
            $n_name        = $rows_task_2['n_name'];
            $notes_st      = $rows_task_2['notes_st'];
?>

          <form action="" id="edit" method="POST">
            <div style="background-color: #f4cae0; margin: 5px; display:flex; border-radius: 10px; padding: 5px;">
                  <p style="font-size: 1.2rem; text-decoration: line-through; flex: 2; color:lightslategray;"><?php echo $notes;?></p>
                  <input type="hidden" name="notes_id" value="<?php echo $notes_id;?>">
                  <button class="btn btn-link" onclick="return confirm('Are you sure to delete this TASK?')" name="delete_task" type="submit"><img width="20px" src="./icons/trash1.png" alt=""></button>
                  <button class="btn btn-link" name="undone_task" type="submit"><img width="20px" src="./icons/nok1.png" alt=""></button>
                  </div>
         
          </form>

          <?php } ?>
          </div>

      <div class="row">
        <div class="col-md-6">
          <h3 style="text-align: center;">Project info</h3>
        <div id="donutchart" style="width: 500px; height: 550px;"></div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Preparing', <?php echo $preparing_project_count;?>],
          ['Working',   <?php echo $working_project_count;?>],
          ['Paused',    <?php echo $paused_project_count;?>],
          ['Testing',   <?php echo $testing_project_count;?>],
          ['Completed', <?php echo $completed_project_count;?>]
        ]);

        var options = {
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

        <div class="col-md-6" style="height:550px; overflow-y: auto;" >
        <h3 style="text-align: center;">All Projects</h3>
        <?php

global $connect;

$sql_all = "SELECT * FROM proejcts";
$sql_all .= " WHERE project_status='Preparing' OR project_status='Paused'";
$sql_all .= " OR project_status='Working' OR project_status='Testing'";
$sql_all .= "ORDER BY project_id DESC";

// show all projects
$result_all = $connect->query($sql_all);

while($rows_all = $result_all->fetch()) {

  $project_id      = $rows_all['project_id'];
  $project_status  = $rows_all['project_status'];
  $project_name    = $rows_all['project_name'];
  $project_start   = $rows_all['project_start_date'];
  $project_end     = $rows_all['project_end_date'];    


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

  if($objectives_count != 0 && $objectives_completed != 0){
    $persent = round(($objectives_completed /$objectives_count) * 100);
    }
    else {
    $persent = 0;
    }
    

?>
<br>
        <div class="row bg-light">
        <br>
       <div class="col-sm"  style="text-align: center;">
        <h3><?php echo  $project_name; ?></h3>
        <p><?php echo  $project_status;?></p>
        </div>
       
    <div class="col-sm">
    <br>
                <div class="row d-flex justify-content-center">
                <div class="tox-progress" data-size="70" data-thickness="15" data-color="#fcba03" data-background="#c1e1e3" data-progress="<?php echo $persent;?>" data-speed="1500">
                  <div class="tox-progress-content todo" data-vcenter="true">
                  <h5> &nbsp;	&nbsp;&nbsp; <?php echo $persent ."%"; ?></h5>
                  </div>
                  </div>
                </div>
           </div>
           <div class="col-sm">
           <br>
           <p><a class="btn btn-sm btn-warning" href="pages/detailed.php?pro_id=<?php echo  $project_id; ?>&name=<?php echo  $project_name; ?>" role="button">Complete</a></p> 
           <p><a class="btn btn-sm btn-success" href="pages/detailed.php?pro_id=<?php echo  $project_id; ?>&name=<?php echo  $project_name; ?>" role="button">View&raquo;</a></p> 
           </div>
           <br>
    </div>  <!--     end of row          -->

<?php } ?>
        </div>

        <br>
        <div class="container otr">
        <div class="row ">
        <?php

      global $connect;
      $sql = "SELECT * FROM workers";

      $stmt = $connect->query($sql);

      while ($rows = $stmt->fetch()) {

        $id        = $rows['workers_id'];
        $Firstname = $rows['workers_firstname'];
        $Lastname  = $rows['workers_lastname'];
        $Email     = $rows['workers_email'];
        $Phone     = $rows['workers_phone'];
        $Password  = $rows['workers_password'];
        $Position  = $rows['workers_position'];
        
      
?>

<style>
 
.otr{
    max-height: 200px;
    overflow-x: scroll;
}
.profile-card-2 img {
    transition: all linear 0.25s;
    border-radius: 10px;
}

.profile-card-2 .profile-name {
    position: absolute;
    left: 30px;
    bottom: 50px;
    font-size: 20px;
    color: #FFF;
    text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
    font-weight: bold;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-icons {
    position: absolute;
    bottom: 30px;
    right: 30px;
    color: #FFF;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-username {
    position: absolute;
    bottom: 20px;
    left: 30px;
    color: #FFF;
    font-size: 12px;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-icons .fa {
    margin: 5px;
}

.profile-card-2:hover img {
    filter: grayscale(100%);
}

.profile-card-2:hover .profile-name {
    bottom: 80px;
}

.profile-card-2:hover .profile-username {
    bottom: 40px;
}

.profile-card-2:hover .profile-icons {
    right: 40px;
}

</style>
		<div class="col-sm-1 m-3">
    <div class="profile-card-2"><img src="https://robohash.org/<?php echo $Firstname; ?>" height="115px" class="img img-responsive bg-dark">
        <div class="profile-name"><?php echo $Firstname;?></div>
        <div class="profile-username"><?php echo $Position;?></div>
        <div class="profile-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
    </div>
</div>



      <?php } ?>
      </div>

      </div>   <!--     end of row        -->
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Project Name', 'Avaible Days', 'Remaining Days'],
          <?php

      global $connect;

      $sql_all = "SELECT * FROM proejcts ORDER BY project_id DESC";

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

      ?>
      ['<?php echo $project_name;?>', <?php echo $project_days;?>, <?php echo $project_days_remain;?>],
    <?php } ?>

        ]);

        var options = {
          chart: {
            title: 'Project Days',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


      <script type="text/javascript">

   /**
* Theme: Metrica - Responsive Bootstrap 4 Admin Dashboard
* Author: Mannatthemes
* Component: Full-Calendar
*/
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      defaultDate: Date.now(),
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(arg) {
        var title = prompt('Add New Event:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }
        calendar.unselect()
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: 
        <?php

           global $connect;

           $data_cal = array();

            $query_cal = "SELECT * FROM proejcts WHERE project_status='Working'";

            $statement = $connect->prepare($query_cal);

            $statement->execute();

            $result_cal = $statement->fetchAll();

            foreach($result_cal as $row_cal)
            {
            $data_cal[] = array(
              'id'      => $row_cal["project_id"],
              'title'   => $row_cal["project_name"],
              'start'   => $row_cal["project_start_date"],
              'end'     => $row_cal["project_end_date"],
              'color'   => $row_cal["project_color"],
            );
            }

            echo json_encode($data_cal);
        ?>
,

          
      // eventClick: function(arg) {
      //   if (confirm('delete event?')) {
      //     arg.event.remove()
      //   }
      // }
    });

    calendar.render();
  });

      </script>
      

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        ToxProgress.create();
        ToxProgress.animate();
    });
</script>
<script src="./js/tox-progress.js"></script>

                            <!-- jQuery  -->
        <script src="./fullcalendar/jquery.min.js"></script>
        <script src="./fullcalendar/bootstrap.bundle.min.js"></script>
        <script src="./fullcalendar/metisMenu.min.js"></script>
        <script src="./fullcalendar/waves.min.js"></script>
        <script src="./fullcalendar/jquery.slimscroll.min.js"></script>

        <script src="./fullcalendar/jquery-ui.min.js"></script>
        <script src="./fullcalendar/moment.js"></script>
        <script src='./fullcalendar/packages/core/main.js'></script>
        <script src='./fullcalendar/packages/daygrid/main.js'></script>
        <script src='./fullcalendar/packages/timegrid/main.js'></script>
        <script src='./fullcalendar/packages/interaction/main.js'></script>
        <script src='./fullcalendar/packages/list/main.js'></script>
        <!-- <script src='./fullcalendar/jquery.calendar.js'></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.c../assets/dist/css/bootstrap.cssloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="js/dashboard.js"></script>


        