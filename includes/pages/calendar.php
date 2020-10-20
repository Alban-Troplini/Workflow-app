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
<!-- calendar  -->

<div id='calendar-container'>
    <div id='calendar'></div>
  </div>

      </div>

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
<script src="js/tox-progress.js"></script>
<script src="js/p_dash.js"></script>
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


        