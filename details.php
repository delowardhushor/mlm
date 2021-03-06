<?php include "./inc/head.php"; ?>
<?php

  if(isset($_GET['details']) && $_GET['details'] !== '' && session::get('usertype') == 'admin'){
    $userid = $_GET['details'];
  }else{
    echo "<script>window.location ='members.php';</script>";
  }

  if(isset($_GET['asbest']) && session::get('usertype') == 'admin'){
    if($db->Update("UPDATE mlm_members SET cat = 1 WHERE id = '$userid'")){
        echo "<script>window.location ='details.php?details=".$userid."&success=Marked as Best';</script>";
    }
  }

  if(isset($_GET['asnot']) && session::get('usertype') == 'admin'){
    if($db->Update("UPDATE mlm_members SET cat = 0 WHERE id = '$userid'")){
        echo "<script>window.location ='details.php?details=".$userid."&success=Remove from Best';</script>";
    }
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_pass']) && session::get('usertype') == 'admin'){
      $pass = md5($_POST['pass']);
      if($db->Update("UPDATE mlm_members SET pass = '$pass' WHERE id = '$userid'")){
        echo "<script>window.location ='details.php?details=".$userid."&success=Password Updated';</script>";
      }else{
        echo "<script>window.location ='details.php?details=".$userid."&error=Password Not Updated';</script>";
      }
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_nam']) && session::get('usertype') == 'admin'){
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      if($db->Update("UPDATE mlm_members SET name = '$name', phone = '$phone' WHERE id = '$userid'")){
        echo "<script>window.location ='details.php?details=".$userid."&success=Updated';</script>";
      }else{
        echo "<script>window.location ='details.php?details=".$userid."&error=Not Updated';</script>";
      }
  }

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;

  $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_member FROM mlm_members WHERE id > '$userid'")))['total_member']/$perpage);
  

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

  $offset = ($page-1)*$perpage;
  $sql_under = "SELECT * FROM mlm_members WHERE id > '$userid' ORDER BY id DESC LIMIT $perpage  OFFSET $offset ";
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

  $income = mysqli_fetch_array($db->select("SELECT * FROM mlm_income WHERE member = '$userid' "));

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-5">
              <div class="alert alert-info">
                <span><?php echo $value_user['name']; ?>'s Current Rank is <?php echo $value_user['rank']; ?></span>
              </div>
            </div>
            <div class="col-md-2">
              <?php if($value_user['cat'] == 0){ ?>
                  <a type="submit" href="?details=<?php echo $userid;?>&asbest=<?php echo $userid;?>" class="btn btn-success pull-right">Mark as Best</a>
              <?php }else{?>
                  <a type="submit" href="?details=<?php echo $userid;?>&asnot=<?php echo $userid;?>" class="btn btn-danger pull-right">Romeve From Best</a>
              <?php }?>
            </div>
            <div class="col-md-5">
              <?php if(session::get('usertype') == 'admin'){ ?>
              <form action="" method="post">
                <div class='row'>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label class="bmd-label-floating">Update Password</label>
                      <input type="password" required="1" name="pass" class="form-control">
                    </div>
                  </div>                 
                  <div class="col-md-5">
                    <input name="update_pass" onclick="return confirm('Are You Sure Update This Password? It can not be undone!')" type="submit" class="btn btn-primary pull-right" value="Update Password" />
                  </div>
                </div>
              </form>
              <?php } ?>
            </div>
          </div>
          <form action="" method="post">
            <div class='row'>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Name</label>
                  <input type="text" required="1" value="<?php echo $value_user['name']; ?>" name="name" class="form-control">
                </div>
              </div>  
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Mobile</label>
                  <input type="text" required="1" value="<?php echo $value_user['phone']; ?>" name="phone" class="form-control">
                </div>
              </div>                 
              <div class="col-md-4">
                <input name="update_nam" type="submit" class="btn btn-primary pull-right" value="Update Name & Mobile" />
              </div>
            </div>
          </form>
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
                    <i class="material-icons">date_range</i> Number of <?php echo $value_user['name']; ?>'s referred member 
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
                  <p class="card-category">Under <?php echo $value_user['name']; ?></p>
                  <h3 class="card-title"><?php if(isset($total_under)){echo $total_under;}else{echo 0;} ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Number of member after <?php echo $value_user['name']; ?>'s genaration
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
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">List of Member Under <?php echo $value_user['name']; ?></h4>
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
                    <li class="page-item"><a class="btn btn-default" href="?details=<?php echo $userid; ?>&page=<?php echo $page-1; ?>">Previous</a></li>
                    <?php
                    } 
                    for($i = 1; $i <= $total_page; $i++){
                    ?>
                    <li class="page-item "><a class="btn  <?php if($page==$i){echo 'btn-primary';}else{echo 'btn-default';} ?>" href="?details=<?php echo $userid; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php 
                    } 
                    if($total_page > $page){
                    ?>
                    <li class="page-item"><a class="btn btn-default" href="?details=<?php echo $userid; ?>&page=<?php echo $page+1; ?>">Next</a></li>
                    <?php } ?>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">List of <?php echo $value_user['name']; ?>'s Referance</h4>
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
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
