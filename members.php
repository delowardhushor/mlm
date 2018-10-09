<?php include "./inc/head.php"; ?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="member.php?mode=Add" type="submit" class="btn btn-primary "><i class="material-icons">person_add</i>  Add Member</a>
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
                          Name
                        </th>
                        <th>
                          Balance
                        </th>
                        <th>
                          Referred
                        </th>
                        <th>
                          Rank
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $sql = "SELECT * FROM mlm_members order by id desc";
                          $result = $db->select($sql);
                          if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo $row['balance']; ?>
                          </td>
                          <td>
                            <?php echo $row['referred']; ?>
                          </td>
                          <td>
                            <?php echo $row['rank']; ?>
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
