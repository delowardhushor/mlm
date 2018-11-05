<?php include "./inc/head.php"; ?>
<?php 
  if(!isset($_GET['member']) || $_GET['member'] == '' || !isset($_GET['mode']) || $_GET['mode'] == '' ){
    header('Location:dashboard.php');
  }else{
    $member = $_GET['member'];
    $mode = $_GET['mode'];
  }
  if(session::get('usertype') !== 'admin' && session::get('userid') !== $member  ){
    header('Location:dashboard.php');
  }
?>
<?php

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;
    $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_cashout FROM mlm_cashout WHERE member = '$member' AND mode = '$mode' ")))['total_cashout']/$perpage);  

  $member_details = mysqli_fetch_array($db->select("SELECT name,balance,tan_bal FROM mlm_members WHERE id = '$member' "));

?>
<?php include "./functions/cash.php"; ?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="alert alert-info">
                <span><?php echo $member_details['name']; ?>'s Current Earned Balance is <?php echo $member_details['balance']; ?></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="alert alert-info">
                <span><?php echo $member_details['name']; ?>'s Current Transferable Balance is <?php echo $member_details['tan_bal']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Cash <?php echo $mode;?> Request</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                  <div class='row'>             
                    <?php if(session::get('usertype') == 'member'){ ?>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cashout Amount</label>
                          <input type="text" required="1" name="amount" class="form-control">
                        </div>
                      </div>
                      <?php //if($mode == 'in'){ ?>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sent Mobile</label>
                          <input type="text" required="1" name="mobile_from" class="form-control">
                        </div>
                      </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <select required="1" class="form-control" name="pay_type" id="sel1">
                                  <option>Select Payment Type</option>
                                  <option  value="bikash">bikash</option>
                                  <option  value="surecash">sure cash</option>
                                  <option  value="rocket">rocket</option>
                                  <option  value="bank">bank</option>
                                  <option  value="hand">hand to hand</option>
                            </select>
                          </div>
                        </div>
                      
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Transaction ID</label>
                          <input type="text" required="1" name="tan_id" class="form-control">
                        </div>
                      </div>
                      <?php //}?>           
                      <div class="col-md-3">
                        <button onclick="return confirm('Are You Sure Cashout This Amount? It can not be undone!')" type="submit" name="cashRequest" class="btn btn-primary "><??>Sent Cash <?php echo $mode; ?> Request</button>
                      </div>
                      <?php } ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php if(session::get('usertype') == 'member'){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Balance Transfer</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class='row'>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Transfer Amount</label>
                          <input type="text" required="1" name="amount" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <button onclick="return confirm('Are You Sure Cashout This Amount? It can not be undone!')" type="submit" name="cashTan" class="btn btn-primary ">Transfer</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
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
                          Sent To
                        </th>
                        <th>
                          Patment By
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
                          $sql = "SELECT * FROM mlm_cashout WHERE member = '$member' AND mode = '$mode' ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
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
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page-1; ?>&mode=<?php echo $mode; ?>&member=<?php echo $member; ?>">Previous</a></li>
                  <?php
                  } 
                  for($i = 1; $i <= $total_page; $i++){
                  ?>
                  <li class="page-item "><a class="btn  <?php if($page==$i){echo 'btn-primary';}else{echo 'btn-default';} ?>" href="?page=<?php echo $i; ?>&mode=<?php echo $mode; ?>&member=<?php echo $member; ?>"><?php echo $i; ?></a></li>
                  <?php 
                  } 
                  if($total_page > $page){
                  ?>
                  <li class="page-item"><a class="btn btn-default" href="?page=<?php echo $page+1; ?>&mode=<?php echo $mode; ?>&member=<?php echo $member; ?>">Next</a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
