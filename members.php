<?php include "./inc/head.php"; ?>
<?php 
  if(session::get('usertype') !== 'admin'){
    echo "<script>window.location ='dashboard.php';</script>";
  }
?>
<?php

  $search = '';

  if(isset($_GET['search'])){
    $search = $_GET['search'];
  }

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $perpage = 50;
  if($search == ''){
    $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_member FROM mlm_members")))['total_member']/$perpage);
  }else{
    $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_member FROM mlm_members WHERE name LIKE '%$search%'")))['total_member']/$perpage);
  }
  

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="row">
                  <?php 
                    $offset = ($page-1)*$perpage;
                    if($search == ''){
                      $sql = "SELECT * FROM mlm_members ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                    }else{
                      $sql = "SELECT * FROM mlm_members WHERE name LIKE '%$search%' ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                    }
                    $result = $db->select($sql);
                    if (!$result) {
                  ?>
                  <div class="col-md-6">
                    <a href="member.php?refer_person=0" type="submit" class="btn btn-primary "><i class="material-icons">person_add</i>  Add Member</a>
                  </div>
                  <?php } ?>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Search</label>
                      <input type="text" name="search" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary ">Search</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Member List</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          User ID
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Username
                        </th>
                        <th>
                          Earned Balance
                        </th>
                        <th>
                          Transferable Balance
                        </th>
                        <th>
                          Referred
                        </th>
                        <th>
                          Rank
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['id']; ?>
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td>
                            <?php echo $row['email']; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo $row['balance']; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo $row['tan_bal']; ?>
                          </td>
                          <td>
                            <?php echo $row['referred']; ?>
                          </td>
                          <td>
                            <?php echo $row['rank']; ?>
                          </td>
                          <td>
                            <a href="member.php?refer_person=<?php echo $row['id']; ?>"  class="btn btn-sm btn-info ">Refer</a>
                            <a href="details.php?details=<?php echo $row['id']; ?>"  class="btn btn-sm btn-info ">Details</a>
                            <a href="cash.php?mode=in&member=<?php echo $row['id']; ?>"  class="btn btn-sm btn-success">Cash In History</a>
                            <a href="cash.php?mode=out&member=<?php echo $row['id']; ?>"  class="btn btn-sm btn-primary  ">Cash Out History</a>
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
