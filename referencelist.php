<?php include "./inc/head.php"; ?>
<?php
  if(session::get('usertype') !== 'member'){
    header('Location:profile.php?error=You dont Have the Permission');
  }

  $userid = session::get('userid');

  $sql_refer = "SELECT id,name,joined,rank FROM mlm_members WHERE parent_member = '$userid' ";
  $result_refer = $db->select($sql_refer);
  if($result_refer){
    $total_refer = $result_refer->num_rows;
  }

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">List of Your Referance</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>SL</th>
                      <th>Full Name</th>
                      <th>Member ID</th>
                      <th>Joined Date</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        if($result_refer && $total_refer > 0){
                          $i=1;
                          while ($refer_member = $result_refer->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        
                        <td><?php echo $refer_member['name']; ?></td>
                        <td><?php echo $refer_member['id']; ?></td>
                        <td><?php echo $format->formatDate($refer_member['joined']); ?></td>
                      </tr>
                      <?php  $i+=1;} } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
