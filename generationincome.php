<?php include "./inc/head.php"; ?>
<?php
  if(session::get('usertype') !== 'member'){
    header('Location:dashboard.php');
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
                  <h4 class="card-title">Generation Income</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Genration</th>
                      <th>Sponser Users</th>
                      <th>Commission</th>
                      <th>Income</th>
                    </thead>
                    <tbody>
                      <?php
                        for($i = 1; $i<=15; $i++){
                        $gen_income = $db->select("SELECT sum(amount), count(member) FROM mlm_genhis WHERE member  = '$userid' AND gen = '$i' ");
                        if($gen_income ){
                          $gen_income_row = mysqli_fetch_array($gen_income);
                      ?>
                      <tr>   
                        <td><?php echo $i; ?></td>                     
                        <td><?php echo $gen_income_row['count(member)'];  ?></td>
                        
                        <td><?php if($i<=5){echo 20;}elseif($i<=10){echo 10;}else{echo 5;}?></td>
                        <td><?php echo $gen_income_row['sum(amount)']; ?></td>
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
