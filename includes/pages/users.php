

<?php

require_once("functions/init.php");

if(isset($_POST["save-worker"])){

  $firstname       = $_POST["firstname"];
  $lastname        = $_POST["lastname"];
  $email           = $_POST["email"];
  $phone           = $_POST["phone"];
  $password        = $_POST["password"];
  $position        = $_POST["position"];


  if(!empty($firstname) && !empty($email) && !empty($password)){
 
    // Query to insert new admin in DB When everything is fine
    global $connect;

    $sql = "INSERT INTO workers(workers_firstname,workers_lastname,workers_email,workers_phone,workers_password,workers_position)";
    $sql .= "VALUES(:Firstname,:Lastname,:Email,:Phone,:Password,:Position)";

    $stmt = $connect->prepare($sql);

    $stmt->bindValue(':Firstname',$firstname);
    $stmt->bindValue(':Lastname', $lastname);
    $stmt->bindValue(':Email',    $email);
    $stmt->bindValue(':Phone',    $phone);
    $stmt->bindValue(':Password', $password);
    $stmt->bindValue(':Position', $position);

    $Execute = $stmt->execute();

    if($Execute){

      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>New worker with the name of ".$firstname." added successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
     
    } else {

      
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Wrong input! Try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   
    }
  } else {

      
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Wrong input! Try again.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
 
  }
}

?>
    <link href="includes/form-validation.css" rel="stylesheet">
    
    <button type="button" class="btn btn-success btn-lg float-right" data-toggle="modal" data-target=".add_worker_modal">New User</button>

<div class="modal fade add_worker_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">
         
      <form action="" id="w-submit" method="POST">
   
    <div class="col-md-8 order-md-1">
      <h4 class="mb-5">New User</h4>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" form="w-submit" name="firstname" class="form-control" >
          </div>

          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" form="w-submit" name="lastname" class="form-control" >
          </div>
        </div>

        <div class="mb-3">
          <label for="Email">Email</label>
          <input type="email" form="w-submit" name="email" class="form-control" placeholder="you@example.com">
        </div>

        <div class="mb-3">
          <label for="Phone">Phone</label>
          <input type="text" form="w-submit" name="phone" class="form-control" >
        </div>

        <div class="mb-3">
          <label for="Password">Password</label>
          <input type="password" form="w-submit" name="password" class="form-control" >
        </div>

        <div class="mb-3">
          <label for="stauts">Position</label>
          <select name="position" class="form-control">
            <option value="Admin">Admin</option>
            <option value="Project Manager">Project Manager</option>
            <option value="Engineer">Engineer</option>
            <option value="Full Stack">Full Stack</option>
            <option value="Front End" selected>Front End</option>
            <option value="Back End">Back End</option>
          </select>
        </div>
        
       </div>  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
        <input type="submit" value="Save" form="w-submit" name="save-worker" class="btn btn-info btn-lg">
      </div>

      </form>
    </div>
  </div>
</div>
<br>

<div class="d-flex row">
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

<div class="card bg-light m-1" style="max-width: 13rem; max-height: 21rem;">
<div class="card-header"> <h5><?php echo $Firstname . " " . $Lastname;?></h5></div>
  <div class="card-body">
 
    <h6 class="card-title"><?php echo $Position;?></h6>
    <p>Phone: <?php echo $Phone;?></p>
    <p>Email: <?php echo $Email;?></p>
    <p>Password: <?php echo $Password;?></p>
    
   <div class="d-flex justify-content-around ">


<button class="btn btn-warning btn-sm"><a style="text-decoration: none; color:white;" href="index.php?ins=update_workers.php&wid=<?php echo $id;?>">Edit</a></button>

        <!---- End of edit modal--->

    <form action="" method="POST">
    <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm" />
    <input type="hidden" name="delete_id" value="<?php echo $id;?>" />
    </form>
  </div>
      </div>
      </div>

      <?php } ?>
 </div>

<?php   

if(isset($_POST['delete'])){

  $del_id = $_POST['delete_id'];

$sql = "DELETE FROM workers WHERE workers_id={$del_id} LIMIT 1";

$stmt = $connect->prepare($sql);
$Execute = $stmt->execute();


}


if(isset($_POST['update-worker'])) {

  $edit_id         = $_POST['edit_id'];
  $firstname       = $_POST["firstname"];
  $lastname        = $_POST["lastname"];
  $email           = $_POST["email"];
  $phone           = $_POST["phone"];
  $password        = $_POST["password"];
  $position        = $_POST["position"];

  $edit_sql = "UPDATE workers SET ";
  $edit_sql .= "workers_firstname = ':Firstname', ";
  $edit_sql .= "workers_lastname  = ':Lastname', ";
  $edit_sql .= "workers_email     = ':Email', ";
  $edit_sql .= "workers_phone     = ':Phone', ";
  $edit_sql .= "workers_password  = ':Password', ";
  $edit_sql .= "workers_position  = ':Position' ";
  $edit_sql .= "WHERE id = {$edit_id}";

  $stmt = $connect->prepare($edit_sql);

    $stmt->bindValue(':Firstname',$firstname);
    $stmt->bindValue(':Lastname', $lastname);
    $stmt->bindValue(':Email',    $email);
    $stmt->bindValue(':Phone',    $phone);
    $stmt->bindValue(':Password', $password);
    $stmt->bindValue(':Position', $position);

  $Execute = $stmt->execute();

  if(!$Execute) {
    die("Query Failed");
  }
}
?>





<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/script.js"></script>

<script src="js/bootstrap.min.js"></script>