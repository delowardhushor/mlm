<?php include "./inc/head.php"; ?>
<?php
  if(session::get('usertype') !== 'member'){
    echo "<script>window.location ='dashboard.php';</script>";
  }

  $userid = session::get('userid');

?>
<?php include "./inc/admin_header.php"; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Board Commission List</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>1st</th>
                      <th>2nd</th>
                      <th>3rd</th>
                      <th>4th</th>
                      <th>5th</th>
                      <th>6th</th>
                      <th>7th</th>
                      
                    </thead>
                    <tbody>
                      <tr>   
                        <td>500</td>                     
                        <td>1000</td>                     
                        <td>2000</td>                     
                        <td>5000</td>                     
                        <td>15000</td>                     
                        <td>50000</td>                     
                        <td>500000</td>                     
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 500</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result500 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 500 ");
                        if($result500){
                          while ($resultrow500 = $result500->fetch_assoc()) {
                          $id = $resultrow500['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow500['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 1000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result1000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 1000 ");
                        if($result1000){
                          while ($resultrow1000 = $result1000->fetch_assoc()) {
                          $id = $resultrow1000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow1000['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 2000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result2000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 2000 ");
                        if($result2000){
                          while ($resultrow2000 = $result2000->fetch_assoc()) {
                          $id = $resultrow2000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow2000['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 5000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result5000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 5000 ");
                        if($result5000){
                          while ($resultrow5000 = $result5000->fetch_assoc()) {
                          $id = $resultrow5000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow5000['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 15000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result10000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 15000 ");
                        if($result10000){
                          while ($resultrow10000 = $result10000->fetch_assoc()) {
                          $id = $resultrow10000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow10000['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 50000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result20000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 50000 ");
                        if($result20000){
                          while ($resultrow20000 = $result20000->fetch_assoc()) {
                          $id = $resultrow20000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow20000['date']); ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">List of Member got 500000</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Time</th>
                      <!-- <th>Balance</th>
                      <th>Rank</th> -->
                    </thead>
                    <tbody>
                      <?php
                        $result50000 = $db->select("SELECT * FROM mlm_comhis WHERE com_by = 'Board' AND amount = 500000 ");
                        if($result50000){
                          while ($resultrow50000 = $result50000->fetch_assoc()) {
                          $id = $resultrow50000['member'];
                          $member = mysqli_fetch_array($db->select("SELECT id, name FROM mlm_members WHERE id = '$id' "));
                      ?>
                      <tr>   
                        <td><?php echo $member['id']; ?></td>                     
                        <td><?php echo $member['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($resultrow50000['date']); ?></td>
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
