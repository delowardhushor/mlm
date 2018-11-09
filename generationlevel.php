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
                  <h4 class="card-title">Generation Level 1</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                        $gen1 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$userid' ORDER BY id DESC ");
                        $gen1_id = array();
                        if($gen1){
                          while ($gen1row = $gen1->fetch_assoc()) {
                          array_push($gen1_id, $gen1row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen1row['id']; ?></td>                     
                        <td><?php echo $gen1row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen1row['joined']); ?></td>
                        <td><?php echo $gen1row['rank']; ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($gen1)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 2</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen1_id); $i++){
                        $looped_id = $gen1_id[$i];
                        $gen2 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen2_id = array();
                        if($gen2){
                          while ($gen2row = $gen2->fetch_assoc()) {
                          array_push($gen2_id, $gen2row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen2row['id']; ?></td>                     
                        <td><?php echo $gen2row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen2row['joined']); ?></td>
                        <td><?php echo $gen2row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen2)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 3</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen2_id); $i++){
                        $looped_id = $gen2_id[$i];
                        $gen3 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen3_id = array();
                        if($gen3){
                          while ($gen3row = $gen3->fetch_assoc()){
                          array_push($gen3_id, $gen3row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen3row['id']; ?></td>                     
                        <td><?php echo $gen3row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen3row['joined']); ?></td>
                        <td><?php echo $gen3row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen3)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 4</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen3_id); $i++){
                        $looped_id = $gen3_id[$i];
                        $gen4 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen4_id = array();
                        if($gen4){
                          while ($gen4row = $gen4->fetch_assoc()) {
                          array_push($gen4_id, $gen4row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen4row['id']; ?></td>                     
                        <td><?php echo $gen4row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen4row['joined']); ?></td>
                        <td><?php echo $gen4row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen4)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 5</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen4_id); $i++){
                        $looped_id = $gen4_id[$i];
                        $gen5 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen5_id = array();
                        if($gen5){
                          while ($gen5row = $gen5->fetch_assoc()) {
                          array_push($gen5_id, $gen5row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen5row['id']; ?></td>                     
                        <td><?php echo $gen5row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen5row['joined']); ?></td>
                        <td><?php echo $gen5row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen5)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 6</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen5_id); $i++){
                        $looped_id = $gen5_id[$i];
                        $gen6 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen6_id = array();
                        if($gen6){
                          while ($gen6row = $gen6->fetch_assoc()) {
                          array_push($gen6_id, $gen6row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen6row['id']; ?></td>                     
                        <td><?php echo $gen6row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen6row['joined']); ?></td>
                        <td><?php echo $gen6row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen6)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 7</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen6_id); $i++){
                        $looped_id = $gen6_id[$i];
                        $gen7 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen7_id = array();
                        if($gen7){
                          while ($gen7row = $gen7->fetch_assoc()) {
                          array_push($gen7_id, $gen7row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen7row['id']; ?></td>                     
                        <td><?php echo $gen7row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen7row['joined']); ?></td>
                        <td><?php echo $gen7row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen7)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 8</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen7_id); $i++){
                        $looped_id = $gen7_id[$i];
                        $gen8 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen8_id = array();
                        if($gen8){
                          while ($gen8row = $gen8->fetch_assoc()) {
                          array_push($gen8_id, $gen8row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen8row['id']; ?></td>                     
                        <td><?php echo $gen8row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen8row['joined']); ?></td>
                        <td><?php echo $gen8row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen8)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 9</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen8_id); $i++){
                        $looped_id = $gen8_id[$i];
                        $gen9 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen9_id = array();
                        if($gen9){
                          while ($gen9row = $gen9->fetch_assoc()) {
                          array_push($gen9_id, $gen9row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen9row['id']; ?></td>                     
                        <td><?php echo $gen9row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen9row['joined']); ?></td>
                        <td><?php echo $gen9row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen9)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 10</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen9_id); $i++){
                        $looped_id = $gen9_id[$i];
                        $gen10 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen10_id = array();
                        if($gen10){
                          while ($gen10row = $gen10->fetch_assoc()) {
                          array_push($gen10_id, $gen10row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen10row['id']; ?></td>                     
                        <td><?php echo $gen10row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen10row['joined']); ?></td>
                        <td><?php echo $gen10row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen10)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 11</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen10_id); $i++){
                        $looped_id = $gen10_id[$i];
                        $gen11 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen11_id = array();
                        if($gen11){
                          while ($gen11row = $gen11->fetch_assoc()) {
                          array_push($gen11_id, $gen11row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen11row['id']; ?></td>                     
                        <td><?php echo $gen11row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen11row['joined']); ?></td>
                        <td><?php echo $gen11row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen11)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 12</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen11_id); $i++){
                        $looped_id = $gen11_id[$i];
                        $gen12 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen12_id = array();
                        if($gen12){
                          while ($gen12row = $gen12->fetch_assoc()) {
                          array_push($gen12_id, $gen12row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen12row['id']; ?></td>                     
                        <td><?php echo $gen12row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen12row['joined']); ?></td>
                        <td><?php echo $gen12row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen12)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 13</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen12_id); $i++){
                        $looped_id = $gen12_id[$i];
                        $gen13 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen13_id = array();
                        if($gen13){
                          while ($gen13row = $gen13->fetch_assoc()) {
                          array_push($gen13_id, $gen13row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen13row['id']; ?></td>                     
                        <td><?php echo $gen13row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen13row['joined']); ?></td>
                        <td><?php echo $gen13row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen13)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 14</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen13_id); $i++){
                        $looped_id = $gen13_id[$i];
                        $gen14 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen14_id = array();
                        if($gen14){
                          while ($gen14row = $gen14->fetch_assoc()) {
                          array_push($gen14_id, $gen14row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen14row['id']; ?></td>                     
                        <td><?php echo $gen14row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen14row['joined']); ?></td>
                        <td><?php echo $gen14row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($gen14)){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Generation Level 15</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Member ID</th>
                      <th>Full Name</th>
                      <th>Date</th>
                      <th>Rank</th>
                    </thead>
                    <tbody>
                      <?php
                      for($i = 0; $i< sizeof($gen14_id); $i++){
                        $looped_id = $gen14_id[$i];
                        $gen15 = $db->select("SELECT * FROM mlm_members WHERE parent_member = '$looped_id' ORDER BY id DESC ");
                        $gen15_id = array();
                        if($gen15){
                          while ($gen15row = $gen15->fetch_assoc()) {
                          array_push($gen15_id, $gen15row['id']);
                      ?>
                      <tr>   
                        <td><?php echo $gen15row['id']; ?></td>                     
                        <td><?php echo $gen15row['name']; ?></td>
                        
                        <td><?php echo $format->formatDate($gen15row['joined']); ?></td>
                        <td><?php echo $gen15row['rank']; ?></td>
                      </tr>
                      <?php } } } ?>
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
