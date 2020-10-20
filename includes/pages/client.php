

<?php

require_once("functions/init.php");

    if(isset($_POST["save-client"])){

        $fullName        = $_POST["full_name"];
        $buisnessName    = $_POST["buisness_name"];
        $phone           = $_POST["phone"];
        $email           = $_POST["email"];
        $projectName     = $_POST["project_name"];
        $iva             = $_POST["iva"];

        if(!empty($fullName) && !empty($buisnessName) && !empty($projectName)){

        global $connect;

        $sql = "INSERT INTO client(client_name,buisness_name,client_phone,client_email,project_name,client_iva)";
        $sql .= "VALUES(:FullName,:BuisnessName,:Phone,:Email,:ProjectName,:Piva)";
    
        $result = $connect->prepare($sql);

        $result->bindValue(':FullName',      $fullName);
        $result->bindValue(':BuisnessName',  $buisnessName);
        $result->bindValue(':Phone',         $phone);
        $result->bindValue(':Email',         $email);
        $result->bindValue(':ProjectName',   $projectName);
        $result->bindValue(':Piva',          $iva);

        $Execute = $result->execute();

        if($Execute){

          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Client has been added!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
         
        }else {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Enter Client data!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      }
    }
  }
    

?>

    
    <button type="button" class="btn btn-warning btn-lg float-right" data-toggle="modal" data-target=".client-modal"><img src="./icons/add_client.png"></button>

<div class="modal fade client-modal" tabindex="-1" role="dialog" aria-labelledby="client-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">
       
    <form action="" id="c-submit" method="POST">

    <div class="col-md-8 order-md-1">
      <h4 class="mb-5">New Client</h4>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="fullname">Full Name</label>
            <input type="text" form="c-submit" name="full_name" class="form-control" >
          </div>

          <div class="col-md-6 mb-3">
            <label for="buisnessname">Buisness Name</label>
            <input type="text" form="c-submit" name="buisness_name" class="form-control" >
          </div>
        </div>

        <div class="mb-3">
          <label for="Phone">Phone</label>
          <input type="text" form="c-submit" name="phone" class="form-control" >
        </div>

        <div class="mb-3">
          <label for="Email">Email</label>
          <input type="email" form="c-submit" name="email" class="form-control" placeholder="you@example.com">
        </div>

        <div class="mb-3">
          <label for="projectname">Project Name</label>
          <input type="text" form="c-submit" name="project_name" class="form-control" >
        </div>  

          <div class="col-md-6 mb-3">
          <label for="startdate">License ID</label>
          <input type="text" form="c-submit" name="iva" class="form-control" >
      </div>

    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
        <input type="submit" value="Save" form="c-submit" name="save-client"  class="btn btn-info btn-lg">
      </div>

      </form>
    </div>
  </div>
</div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Full Name</th>
      <th scope="col">Buisness Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Project Name</th>
      <th scope="col">Licene ID</th>
    </tr>
  </thead>

<?php

      global $connect;
      $sql = "SELECT * FROM client ORDER BY client_id DESC";

      $stmt = $connect->query($sql);

      while ($DataRows = $stmt->fetch()) {

        $id            = $DataRows['client_id'];
        $fullName      = $DataRows['client_name'];
        $buisnessName  = $DataRows['buisness_name'];
        $phone         = $DataRows['client_phone'];
        $email         = $DataRows['client_email'];
        $projectName   = $DataRows['project_name'];
        $piva          = $DataRows['client_iva'];

      
?>

  <tbody class="table-striped table">
    <tr>
      <td><?php echo $fullName;?></td>
      <td><?php echo $buisnessName;?></td>
      <td><?php echo $phone;?></td>
      <td><?php echo $email;?></td>
      <td><?php echo $projectName;?></td>
      <td><?php echo $piva;?></td>
      <td><button class="btn btn-success btn-sm"><a href="index.php?ins=client.php?upc=<?php echo $id;?>"><img src="./icons/edit_client.png"></a></button></td>
      <td>
      <form action="" method="POST">
    <button type="submit" name="delete_client" value="Delete" class="btn btn-danger btn-sm"><img src="./icons/delete_client.png"></button>
    <input type="hidden" name="delete_client_id" value="<?php echo $id;?>" />
    </form>
  </div>
  </td>
      <td><button type="button" class="btn btn-info btn-sm"><img src="./icons/email.png"></button></td>
    </tr>
  </tbody>




    <?php } ?>
    </table>

    <?php 

        if(isset($_POST['delete_client'])){


          $del_id = $_POST['delete_client_id'];
        
        $sql = "DELETE FROM client WHERE client_id={$del_id} LIMIT 1";
        
        $stmt = $connect->prepare($sql);
        $Execute = $stmt->execute();
        }


    ?>
    

<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/script.js"></script>

<script src="js/bootstrap.min.js"></script>