<?php include "./inc/head.php"; ?>
<?php

  $userid = session::get('userid');
  
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;

  $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_member FROM mlm_members WHERE id > '$userid'")))['total_member']/$perpage);

  $sql_user_bal = "SELECT * FROM mlm_users WHERE id = 1 LIMIT 1";
  $result_user_bal = $db->select($sql_user_bal);
  if($result_user_bal){
    $value_user_bal = mysqli_fetch_array($result_user_bal);
  }

  $sql_user = "SELECT * FROM mlm_members WHERE id = '$userid' LIMIT 1";
  $result_user = $db->select($sql_user);
  if($result_user){
    $value_user = mysqli_fetch_array($result_user);
  }

  $sql_all = "SELECT * FROM mlm_members";
  $result_all = $db->select($sql_all);
  if($result_all){
    $total_all = $result_all->num_rows;
  }

  function get_gen(){

  }

  $offset = ($page-1)*$perpage;
  $sql_under = "SELECT * FROM mlm_members WHERE id > '$userid' ORDER BY id ASC LIMIT $perpage  OFFSET $offset ";
  $result_under = $db->select($sql_under);
  if($result_under){
    $total_under = $result_under->num_rows;
  }
  

  $sql_refer = "SELECT * FROM mlm_members WHERE parent_member = '$userid' ";
  $result_refer = $db->select($sql_refer);
  if($result_refer){
    $total_refer = $result_refer->num_rows;
  }

  $sql_latest = "SELECT * FROM mlm_members ORDER BY id DESC LIMIT 10";
  $result_latest = $db->select($sql_latest);
  if($result_latest){
    $total_latest = $result_latest->num_rows;
  }

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <?php if(session::get('usertype') == 'member'){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-info">
                <span><?php echo $value_user['name']; ?>, Your Current Rank is <?php echo $value_user['rank']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">money</i>
                  </div>
                  <p class="card-category">Balance</p>
                  <h3 class="card-title">৳ <?php echo $value_user['balance']; ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">money</i>
                    Add More Member to Get More...
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">group</i>
                  </div>
                  <p class="card-category">Reference</p>
                  <h3 class="card-title"><?php if(isset($total_refer)){echo $total_refer;}else{echo 0;} ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Number of your referred member 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">people</i>
                  </div>
                  <p class="card-category">Under You</p>
                  <h3 class="card-title"><?php if(isset($total_under)){echo $total_under;}else{echo 0;} ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Number of member under your
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">people</i>
                  </div>
                  <p class="card-category">Total Member</p>
                  <h3 class="card-title"><?php  if(isset($total_all)){echo $total_all;}else{echo 0; } ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Total number of members
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if(session::get('usertype') == 'member'){ 
            $income = mysqli_fetch_array($db->select("SELECT * FROM mlm_income WHERE member = '$userid' "));
          ?>
          <div class="row">
            <div class="col-md-3">
              <div class="alert alert-info">
                <span>Earn by Generation <?php echo $income['by_generation']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-primary">
                <span>Earn by Rank <?php echo $income['by_rank']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-danger">
                <span>Earn by Board Commission <?php echo $income['by_board']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-success">
                <span>Earn by Referance <?php echo $income['by_refer']; ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">List of Member Under You</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Name</th>
                      <th>Balance</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                        if($result_under && $total_under > 0){
                          while ($under_member = $result_under->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $under_member['name']; ?></td>
                        <td><?php echo $under_member['balance']; ?></td>
                        <td><?php echo $under_member['rank']; ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
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
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">List of Your Referance</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Name</th>
                      <th>Balance</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                        if($result_refer && $total_refer > 0){
                          while ($refer_member = $result_refer->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $refer_member['name']; ?></td>
                        <td><?php echo $refer_member['balance']; ?></td>
                        <td><?php echo $refer_member['rank']; ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(session::get('usertype') == 'admin'){ ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">money</i>
                  </div>
                  <p class="card-category">Total Income</p>
                  <h3 class="card-title">৳ <?php if(isset($total_all)){echo $total_all*1000;}else{echo 0; } ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">money</i>
                    Add More Member to Get More...
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">people</i>
                  </div>
                  <p class="card-category">Total Member</p>
                  <h3 class="card-title"><?php  if(isset($total_all)){echo $total_all;}else{echo 0; } ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Total number of members
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="alert alert-info">
                <span>Generation Balance <?php echo $value_user_bal['gen_bal']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-primary">
                <span>Rank Balance <?php echo $value_user_bal['balance']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-danger">
                <span>Board Commission Balance <?php echo $value_user_bal['board_bal']; ?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert alert-success">
                <span>ID Card Balance <?php echo $value_user_bal['id_bal']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">List of Latest Member</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Name</th>
                      <th>Balance</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                        if($result_latest && $total_latest > 0){
                          while ($latest_member = $result_latest->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $latest_member['name']; ?></td>
                        <td><?php echo $latest_member['balance']; ?></td>
                        <td><?php echo $latest_member['rank']; ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
