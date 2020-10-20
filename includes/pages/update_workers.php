
<?php require_once('functions/init.php');?>

<?php 

if(isset($_POST['update-worker'])) {

 
    $firstname       = $_POST["firstname"];
    $lastname        = $_POST["lastname"];
    $email           = $_POST["email"];
    $phone           = $_POST["phone"];
    $password        = $_POST["password"];
    $position        = $_POST["position"];
  
    $edit_sql = "UPDATE workers SET ";
    $edit_sql .= "workers_firstname = :Firstname, ";
    $edit_sql .= "workers_lastname  = :Lastname, ";
    $edit_sql .= "workers_email     = :Email, ";
    $edit_sql .= "workers_phone     = :Phone, ";
    $edit_sql .= "workers_password  = :Password, ";
    $edit_sql .= "workers_position  = :Position ";
    $edit_sql .= "WHERE workers_id = {$_GET['wid']}";
  
    $result_update = $connect->prepare($edit_sql);
  
      $result_update->bindValue(':Firstname',$firstname);
      $result_update->bindValue(':Lastname', $lastname);
      $result_update->bindValue(':Email',    $email);
      $result_update->bindValue(':Phone',    $phone);
      $result_update->bindValue(':Password', $password);
      $result_update->bindValue(':Position', $position);
  
    $Execute_update = $result_update->execute();
  
    if(!$Execute_update) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error to update user! Try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>'; 
    }
    else {
      header("Location: index.php?ins=workers.php");
    }
  }
  ?>

<?php

global $connect;
if(isset($_GET['wid'])) {

$sql_edit_worker = "SELECT * FROM workers WHERE workers_id={$_GET['wid']}";

$result_edit_worker = $connect->query($sql_edit_worker);

while ($rows1 = $result_edit_worker->fetch()) {

  $uid        = $rows1['workers_id'];
  $uFirstname = $rows1['workers_firstname'];
  $uLastname  = $rows1['workers_lastname'];
  $uEmail     = $rows1['workers_email'];
  $uPhone     = $rows1['workers_phone'];
  $uPassword  = $rows1['workers_password'];
  $uPosition  = $rows1['workers_position'];
}

}
?>

<div class="container">
<form action="" id="u-submit" method="POST">
   
    <div class="col-md-8 order-md-1">
      <h4 class="mb-5">Update User</h4>

        <div class="d-flex justify-content-around">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" form="u-submit" value="<?php echo $uFirstname; ?>" name="firstname" class="form-control" >
          </div>

          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" form="u-submit" value="<?php echo $uLastname; ?>" name="lastname" class="form-control" >
          </div>
        </div>

        <div class="mb-3">
          <label for="Email">Email</label>
          <input type="email" form="u-submit" value="<?php echo $uEmail; ?>" name="email" class="form-control" placeholder="you@example.com">
        </div>

        <div class="mb-3">
          <label for="Phone">Phone</label>
          <input type="text" form="u-submit" value="<?php echo $uPhone; ?>" name="phone" class="form-control" >
        </div>

        <div class="mb-3">
          <label for="Password">Password</label>
          <input type="password" form="u-submit" value="<?php echo $uPassword; ?>" name="password" class="form-control" >
        </div>

      <div class="row">

        <div class="mb-3">
          <label for="stauts">Position</label>
          <select name="position" class="form-control" selected="<?php echo $uPosition;?>" default="<?php echo $uPosition;?>">
            <option value="Admin">Admin</option>
            <option value="Project Manager">Project Manager</option>
            <option value="Engineer">Engineer</option>
            <option value="Full Stack">Full Stack</option>
            <option value="Front End">Front End</option>
            <option value="Back End">Back End</option>
          </select>
        </div>
       
      <div >
            <br>
        <input type="submit" value="Update" form="u-submit" name="update-worker" class="btn btn-info">
      </div>
      </div>
</form>
<br><br>
</div>

