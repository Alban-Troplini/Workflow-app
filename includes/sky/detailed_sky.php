<?php   if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>

<?php

function add_objectives(){
    if(isset($_POST['add_obj'])) {

        if(!empty($_POST['objective'])){

          $objective        = $_POST['objective'];
          $project_id       = $_GET['pro_id'];
          $objective_status = 1;
          $obj_name = "";
          
       
          global $connect;
  
         $sql = "INSERT INTO project_objectives(objectives, project_status, project_id, u_name)";
         $sql .= "VALUES(:objective, :objective_status, :project_id, :obj_name)";
  
          $stmt = $connect->prepare($sql);
  
         
          $stmt->bindValue(':objective',          $objective);
          $stmt->bindValue(':objective_status',   $objective_status);
          $stmt->bindValue(':project_id',         $project_id);
          $stmt->bindValue(':obj_name',           $obj_name);
         
  
          $execute = $stmt->execute();
  
          if($execute){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Objective has been added succsessfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
          }

        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Objective was not saved! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
      }  else { 
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Input an objective!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
      }
        }
}





function add_notes(){
  if(isset($_POST['add_notes'])) {

      if(!empty($_POST['notes'])){

        $notes       = $_POST['notes'];
        $project_id  = $_GET['pro_id'];
        $n_name      = $_SESSION['name'];
        $st_status   = 3;
     
        global $connect;

       $sql = "INSERT INTO project_notes(notes, project_id, n_name, notes_st)";
       $sql .= "VALUES(:notes, :project_id, :n_name, :st_status)";

        $stmt = $connect->prepare($sql);

       
        $stmt->bindValue(':notes',          $notes);
        $stmt->bindValue(':project_id',     $project_id);
        $stmt->bindValue(':n_name',         $n_name);
        $stmt->bindValue(':st_status',      $st_status);

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Note has been added succsessfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }

      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Note was not saved! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }  else { 
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Write something!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
    }
      }
}


function add_notes_task(){
  if(isset($_POST['add_task_1'])) {

      if(!empty($_POST['task'])){

        $notes       = $_POST['task'];
        $project_id  = 1;
        $n_name      = $_SESSION['name'];
        $st_status   = 1;
        
     
        global $connect;

       $sql = "INSERT INTO project_notes(notes, project_id, n_name, notes_st)";
       $sql .= "VALUES(:notes, :project_id, :n_name, :st_status)";

        $stmt = $connect->prepare($sql);

       
        $stmt->bindValue(':notes',          $notes);
        $stmt->bindValue(':project_id',     $project_id);
        $stmt->bindValue(':n_name',         $n_name);
        $stmt->bindValue(':st_status',      $st_status);
       

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Task has been added succsessfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }

      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Task was not saved! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }  else { 
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Write something!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
    }
      }
}



function delete_objective() {

    if(isset($_POST['delete_obj'])) {

        $d_id = $_POST['obj_id'];

        global $connect;
  
      $sql = "DELETE FROM project_objectives WHERE objectives_id = {$d_id}";

          $stmt = $connect->prepare($sql);
  
          $execute = $stmt->execute();
  
          if($execute){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Objective has been deleted succsessfully
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
          }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error to delete this objective! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
      }
}




function delete_notes() {

  if(isset($_POST['delete_notes'])) {

      $d_id = $_POST['notes_id'];

      global $connect;

    $sql = "DELETE FROM project_notes WHERE notes_id = {$d_id}";

        $stmt = $connect->prepare($sql);

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Note has been deleted succsessfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error to delete this note! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }
}



function delete_task() {

  if(isset($_POST['delete_task'])) {

      $d_id = $_POST['notes_id'];

      global $connect;

    $sql = "DELETE FROM project_notes WHERE notes_id = {$d_id}";

        $stmt = $connect->prepare($sql);

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Task has been deleted succsessfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error to delete this task! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }
}

function done_task(){
  if(isset($_POST['done_task'])) {

      $n_id = $_POST['notes_id'];
      $name_obj = $_SESSION['name'];

      global $connect;

  $sql = "UPDATE project_notes SET notes_st=2, n_name='{$name_obj}' WHERE notes_id = {$n_id}";

        $stmt = $connect->prepare($sql);

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Objective completed!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }
}



function undone_task(){
  if(isset($_POST['undone_task'])) {

      $n_id = $_POST['notes_id'];
      $name_obj = $_SESSION['name'];

      global $connect;

  $sql = "UPDATE project_notes SET notes_st=1, n_name='{$name_obj}' WHERE notes_id = {$n_id}";

        $stmt = $connect->prepare($sql);

        $execute = $stmt->execute();

        if($execute){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Objective completed!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        }
      else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! Try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'; 
      }
    }
}




function done_objective(){
    if(isset($_POST['done_obj'])) {

        $u_id = $_POST['obj_id'];
        $name_obj = $_SESSION['name'];

        global $connect;
  
    $sql = "UPDATE project_objectives SET project_status=0, u_name='{$name_obj}' WHERE objectives_id = {$u_id}";

          $stmt = $connect->prepare($sql);
  
          $execute = $stmt->execute();
  
          if($execute){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Objective completed!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
      }
}




function undone_objective() {

    if(isset($_POST['undone_obj'])) {

        $undone_id = $_POST['obj_id'];


        global $connect;
  
    $sql = "UPDATE project_objectives SET project_status=1, u_name=null WHERE objectives_id = {$undone_id} ";

          $stmt = $connect->prepare($sql);
  
          $execute = $stmt->execute();
  
          if($execute){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Objective assigned to uncomplted tasks!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! Try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>'; 
        }
      }
}


?>