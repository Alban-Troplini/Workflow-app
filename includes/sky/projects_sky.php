
<?php 

// add new project!
function add_project(){

    if(isset($_POST['add_project'])){

        if(!empty($_POST['project_name'])){
  
          $ProjectName        = $_POST['project_name'];
          $ProjectStatus      = $_POST['project_status'];
          $Project_start_date = $_POST['project_start_date'];
          $Project_end_date   = $_POST['project_end_date'];
          $Project_color      = $_POST['project_color'];
  
          global $connect;
  
         $sql = "INSERT INTO proejcts(project_status, project_name, project_start_date, project_end_date, project_color)";
         $sql .= "VALUES(:project_status, :project_name, :project_start, :project_end, :project_color)";
  
          $stmt = $connect->prepare($sql);
  
          $stmt->bindValue(':project_name',  $ProjectName);
          $stmt->bindValue(':project_status',$ProjectStatus);
          $stmt->bindValue(':project_start', $Project_start_date);
          $stmt->bindValue(':project_end',   $Project_end_date);
          $stmt->bindValue(':project_color', $Project_color);
  
          $execute = $stmt->execute();
  
          if($execute){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Your project has been added!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
          }
  
        
        else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! Enter project data.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          
        }
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! Enter project data.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
        }
}


// delete project and objectives !!!
function delete_project(){
if(isset($_POST['delete_project'])){



  $del_project_id = $_POST['project_id'];

  global $connect;


  $sql_delete_objectives = "DELETE FROM project_objectives WHERE project_id = {$del_project_id}";

  $result_del_objectives = $connect->prepare($sql_delete_objectives);

  $execute = $result_del_objectives->execute();
  
  $sql = "DELETE FROM proejcts WHERE project_id = {$del_project_id}";

      $stmt = $connect->prepare($sql);

      $execute = $stmt->execute();

      if($execute){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Project and Objectives has been deleted!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>'; 
      }
    else {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error to delete this project! Try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>'; 
    }
}
}


// approve projec to completed projects
function approve_project(){
  if(isset($_POST['approve_project'])){
  
    $approve_project_id = $_POST['project_id'];
  
    global $connect;
    
    $sql = "UPDATE proejcts SET project_status='Completed' WHERE project_id = {$approve_project_id}";
  
        $stmt = $connect->prepare($sql);
  
        $execute = $stmt->execute();
  
        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Project has been Approved succsessfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error to approve this project! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
  }
  }


    //start to work project
    function on_work_project(){
      if(isset($_POST['on_work'])){
      
        $on_work_project_id = $_POST['project_id'];
      
        global $connect;
        
        $sql_test = "UPDATE proejcts SET project_status='Working' WHERE project_id = {$on_work_project_id}";
      
            $stmt = $connect->prepare($sql_test);
      
            $execute = $stmt->execute();
      
            if($execute){
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Project on work!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'; 
            }
          else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error to start working with this project! Try again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'; 
          }
      }
      }



        //back to prepare project
    function prepare_project(){
      if(isset($_POST['to_prepare'])){
      
        $prepare_project_id = $_POST['project_id'];
      
        global $connect;
        
        $sql_test = "UPDATE proejcts SET project_status='Preparing' WHERE project_id = {$prepare_project_id}";
      
            $stmt = $connect->prepare($sql_test);
      
            $execute = $stmt->execute();
      
            if($execute){
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Project back to prepare!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'; 
            }
          else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error to get back on preparing mode this project! Try again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'; 
          }
      }
      }



  //bring back project from completed to working projects
  function back_work_project(){
    if(isset($_POST['working_project'])){
    
      $back_work_project_id = $_POST['project_id'];
    
      global $connect;
      
      $sql = "UPDATE proejcts SET project_status='Working' WHERE project_id = {$back_work_project_id}";
    
          $stmt = $connect->prepare($sql);
    
          $execute = $stmt->execute();
    
          if($execute){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Project on WORK!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
          }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error to send back oo WORK ! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
    }
    }


    //send project to testing projects
function to_test_project(){
  if(isset($_POST['to_test_project'])){
  
    $to_test_project_id = $_POST['project_id'];
  
    global $connect;
    
    $sql_test = "UPDATE proejcts SET project_status='Testing' WHERE project_id = {$to_test_project_id}";
  
        $stmt = $connect->prepare($sql_test);
  
        $execute = $stmt->execute();
  
        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Project has been Approved succsessfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error to approve this project! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
  }
  }



  //STOP project
  function pause_project(){
    if(isset($_POST['pause_project'])){
    
      $pause_project_id = $_POST['project_id'];
    
      global $connect;
      
      $sql_pause = "UPDATE proejcts SET project_status='Paused' WHERE project_id = {$pause_project_id}";
    
          $stmt = $connect->prepare($sql_pause);
    
          $execute = $stmt->execute();
    
          if($execute){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Project on pause!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
          }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error to pause this project! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
    }
    }
?>