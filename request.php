<?php include "./inc/head.php"; ?>
<?php
  if(session::get('usertype') !== 'admin'){
    header('Location:profile.php?error=You dont Have the Permission');
  }

  if(!isset($_GET['mode']) || $_GET['mode'] == '' ){
    header('Location:dashboard.php');
  }else{
    $mode = $_GET['mode'];
  }

  if(isset($_GET['delete']) && session::get('usertype') == 'admin'){
    $delete = $_GET['delete'];
    if($db->delete("DELETE FROM mlm_cashout WHERE id = '$delete'")){
      header('Location:request.php?mode='.$mode.'&success=Request Deleted');
    }
  }

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Cash <?php echo $mode; ?> Request</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Date
                        </th>
                        <th>
                          From
                        </th>
                        <th>
                          Transaction ID
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Amount
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $sql = "SELECT * FROM mlm_cashout WHERE approve = 'pending' AND mode = '$mode' ";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $format->formatDate($row['date']); ?>
                          </td>
                          <td >
                            <?php echo $row['mobile_from']; ?>
                          </td>
                          <td >
                            <?php echo $row['tan_id']; ?>
                          </td>
                          <td >
                            <?php echo $row['approve']; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo $row['amount']; ?>
                          </td>
                          <td>
                            <a href="confirm.php?mode=<?php echo $mode; ?>&approve=<?php echo $row['id']; ?>" class="btn btn-primary ">approve</a>
                            <a onclick="return confirm('Delete This Request!')" href="request.php?mode=<?php echo $mode; ?>&delete=<?php echo $row['id']; ?>" class="btn btn-danger "><i class="material-icons">delete</i></a>
                          </td>
                        </tr>
                        <?php
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
