<?php include "./inc/head.php"; ?>
<?php
  if(session::get('usertype') !== 'admin'){
    header('Location:profile.php?error=You dont Have the Permission');
  }
?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="package.php?mode=Add" type="submit" class="btn btn-primary "><i class="material-icons">person_add</i>  Add Package</a>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Package List</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Name
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Stock
                        </th>
                        <th>
                          Details
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $sql = "SELECT * FROM mlm_packages";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td>
                            <?php echo $row['price']; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo $row['stock']; ?>
                          </td>
                          <td>
                            <?php echo $row['details']; ?>
                          </td>
                          <td>
                            <a href="package.php?mode=Update&id=<?php echo $row['id']; ?>" class="btn btn-primary "><i class="material-icons">border_color</i></a>
                            <a onclick="return confirm('Delete This Package!')" href="package.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger "><i class="material-icons">delete</i></a>
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
