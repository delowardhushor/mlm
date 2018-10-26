<?php include "./inc/head.php" ?>
<?php //include "./functions/member.php"; ?>
<?php include "./inc/admin_header.php" ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Member</h4>
                  <!-- <p class="card-category">Complete your profile</p> -->
                </div>
                <div class="card-body">
                  <form action="./functions/member.php" method='POST'>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" name="name" required="1" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="email" required="1"  class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" name="pass" required="1" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" name="phone" required="1" class="form-control">
                        </div>
                      </div>
                    </div>
                    <?php if(session::get('usertype') == 'admin'){ ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="sel1">Select Reference</label>
                          <select class="form-control" name="parent_member" id="sel1">
                            <?php 
                              $member_sql = "SELECT * FROM mlm_members order by id asc";
                              $member_result = $db->select($member_sql); 
                              if ($member_result->num_rows > 0) {
                                  while($member_row = $member_result->fetch_assoc()) {
                              ?>
                                <option  value="<?php echo $member_row["id"]; ?>"><?php echo  $member_row["name"]; ?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                      <input type="text" style="display: none" name="parent_member" value="<?php echo session::get('userid'); ?>">
                    <?php } ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="sel1">Select Package</label>
                          <select required="1" class="form-control" name="package" id="sel1">
                            <?php 
                              $package_sql = "SELECT * FROM mlm_packages";
                              $package_result = $db->select($package_sql); 
                              if ($package_result->num_rows > 0) {
                                  while($package_row = $package_result->fetch_assoc()) {
                              ?>
                                <option value="<?php echo $package_row["id"]; ?>"><?php echo  $package_row["name"]; ?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Details</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Add Details</label>
                            <textarea name="details" class="form-control" rows="5"><?php if($mode === 'Update'){ echo $value['details']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <input style="display: none" name="usertype" value="<?php echo session::get('usertype'); ?>">
                    <button onclick="return confirm('Have You Reviewed All Information? It can not be undone!')" type="submit" class="btn btn-primary pull-right">Add Member</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>