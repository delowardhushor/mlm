<?php include "./inc/head.php"; ?>
<?php 
  if(session::get('usertype') !== 'admin'){
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

  $total_page = ceil((mysqli_fetch_array($db->select("SELECT COUNT(id) AS total_member FROM mlm_members WHERE cat = 1")))['total_member']/$perpage);
  

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="row">
                  <div class="col-md-6">
                    <a href="member.php?mode=Add" type="submit" class="btn btn-primary "><i class="material-icons">person_add</i>  Add Member</a>
                  </div>
                  <!-- 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Search</label>
                      <input type="text" name="search" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary ">Search</button>
                  </div> -->
                </div>
              </form>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Best Member List</h4>
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
                          $offset = ($page-1)*$perpage;
                          $sql = "SELECT * FROM mlm_members WHERE cat = 1 ORDER BY id DESC LIMIT $perpage  OFFSET $offset";
                          $result = $db->select($sql);
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
