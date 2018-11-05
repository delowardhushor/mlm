<?php include "./inc/head.php"; ?>
<?php 
  if(session::get('usertype') != 'admin' || !isset($_GET['mode']) || $_GET['mode'] == '' ){
    header('Location:dashboard.php');
  }else{
    $mode = $_GET['mode'];
  }
?>
<?php

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;
    $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_cashout FROM mlm_cashout WHERE mode = '$mode' ")))['total_cashout']/$perpage);

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Cash <?php echo $mode; ?> History</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Date
                        </th>
                        <th>
                          Requested By
                        </th>
                        <th>
                          Sent To
                        </th>
                        <th>
                          Payment By
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
                      </thead>
                      <tbody>
                        <?php 
                          $offset = ($page-1)*$perpage;
                          $sql = "SELECT * FROM mlm_cashout WHERE mode = '$mode' ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $format->formatDate($row['date']); ?>
                          </td>
                          <td>
                          <?php
                            $member = $row['member'];
                            echo mysqli_fetch_array($db->select("SELECT name FROM mlm_members WHERE id = '$member' "))['name'];
                          ?>
                          </td>
                          <td >
                            <?php echo $row['mobile_from']; ?>
                          </td>
                          <td >
                            <?php echo $row['pay_type']; ?>
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
          <div class="row">
            <div class="col-md-12">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php if($page > 1){ ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page-1; ?>&mode=<?php echo $mode; ?>">Previous</a></li>
                  <?php
                  } 
                  for($i = 1; $i <= $total_page; $i++){
                  ?>
                  <li class="page-item "><a class="btn  <?php if($page==$i){echo 'btn-primary';}else{echo 'btn-default';} ?>" href="?page=<?php echo $i; ?>&mode=<?php echo $mode; ?>"><?php echo $i; ?></a></li>
                  <?php 
                  } 
                  if($total_page > $page){
                  ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page+1; ?>&mode=<?php echo $mode; ?>">Next</a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
