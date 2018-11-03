<?php include "./inc/head.php"; ?>
<?php 
  if(session::get('usertype') !== 'admin'){
    header('Location:dashboard.php');
  }
?>
<?php 
  if(isset($_GET['done']) && session::get('usertype') == 'admin'){
    $id = $_GET['done'];
    $package = mysqli_fetch_array($db->select("SELECT package FROM mlm_members WHERE id = '$id' LIMIT 1"))['package'];
    if(
      $db->update("UPDATE mlm_members SET package_pen = 1 WHERE id = '$id'")
      &&
      $db->update("UPDATE mlm_packages SET stock = stock-1 WHERE id = '$package'")
    ){
      header('Location:packagedelivery.php?success=Package Delivered');
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
                            $sql = "SELECT * FROM mlm_members WHERE package_pen = 0 ";
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
                            <a href="packagedelivery.php?done=<?php echo $row['id']; ?>"  class="btn btn-sm btn-info ">Delivery Done</a>
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
