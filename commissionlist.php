<?php include "./inc/head.php"; ?>
<?php 
  if(session::get('usertype') !== 'member'){
    header('Location:dashboard.php');
  }
?>
<?php

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $userid = session::get('userid');

  $perpage = 50;

  $pageCountSql = $db->select("SELECT COUNT(id) AS total_cashout, sum(amount) FROM mlm_comhis WHERE member = '$userid' ");

  if($pageCountSql && mysqli_num_rows($pageCountSql)){
    $page_array = mysqli_fetch_array($pageCountSql);
    $total_page = ceil($page_array['total_cashout']/$perpage); 
    $Total_com = $page_array['sum(amount)'];
  }

   

?>
<?php include "./functions/cash.php"; ?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 col-12">
              <div class="alert alert-primary">
                <span>Total Commission Earned <?php if(isset($Total_com)){echo $Total_com;} ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Commission History</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Date
                        </th>
                        <th>
                          Commission From
                        </th>
                        <th>
                          Amount
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $offset = ($page-1)*$perpage;
                          $sql = "SELECT * FROM mlm_comhis WHERE member = '$userid' ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                          <td>
                            <?php echo $format->formatDate($row['date']); ?>
                          </td>
                          <td >
                            <?php echo $row['com_by']; ?>
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
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page-1; ?>">Previous</a></li>
                  <?php
                  } 
                  for($i = 1; $i <= $total_page; $i++){
                  ?>
                  <li class="page-item "><a class="btn  <?php if($page==$i){echo 'btn-primary';}else{echo 'btn-default';} ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php 
                  } 
                  if($total_page > $page){
                  ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page+1; ?>">Next</a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
