<?php include "./inc/head.php"; ?>
<?php 
  if(!isset($_GET['member']) || $_GET['member'] == ''){
    header('Location:statistics.php');
  }else{
    $member = $_GET['member'];
  }
  if(session::get('usertype') !== 'admin' && session::get('userid') !== $member  ){
    header('Location:statistics.php');
  }
?>
<?php

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;
    $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_cashout FROM mlm_cashout WHERE member = '$member'")))['total_cashout']/$perpage);  

  $member_details = mysqli_fetch_array($db->select("SELECT name,balance FROM mlm_members WHERE id = '$member'"));

?>
<?php include "./functions/cash.php"; ?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="alert alert-info">
                      <span><?php echo $member_details['name']; ?>'s Current Balance is <?php echo $member_details['balance']; ?></span>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Cashout Amount</label>
                      <input type="text" required="1" name="amount" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button onclick="return confirm('Are You Sure Cashout This Amount? It can not be undone!')" type="submit" class="btn btn-primary ">Cashout Now</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Cash out History</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Name
                        </th>
                        <th>
                          Balance
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $offset = ($page-1)*$perpage;
                          $sql = "SELECT * FROM mlm_cashout WHERE member = '$member' ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $format->formatDate($row['date']); ?>
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
            <div class="col-md-12">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php if($page > 1){ ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page-1; if($search !== ''){echo '&search='.$search; } ?>">Previous</a></li>
                  <?php
                  } 
                  for($i = 1; $i <= $total_page; $i++){
                  ?>
                  <li class="page-item "><a class="btn  <?php if($page==$i){echo 'btn-primary';}else{echo 'btn-default';} ?>" href="?page=<?php echo $i; if($search !== ''){echo '&search='.$search; } ?>"><?php echo $i; ?></a></li>
                  <?php 
                  } 
                  if($total_page > $page){
                  ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page+1; if($search !== ''){echo '&search='.$search; } ?>">Next</a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
