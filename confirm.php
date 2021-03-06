<?php include "./inc/head.php" ?>
<?php
  if(session::get('usertype') !== 'admin'){
    echo "<script>window.location ='dashboard.php';</script>";
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && session::get('usertype') == 'admin'){
    $id  = $_POST['id'];
    $mode = $_POST['mode'];
    $member = $_POST['member'];
    $mobile_from = $_POST['mobile_from'];
    $tan_id = $_POST['tan_id'];
    $amount = $_POST['amount'];
    $pay_type = $_POST['pay_type'];

    $db->update("UPDATE mlm_cashout SET amount = '$amount', mobile_from = '$mobile_from', tan_id = '$tan_id', pay_type = '$pay_type' , approve = 'approved' WHERE id = '$id' ");

    if($mode == 'in'){
      $db->update("UPDATE mlm_members SET tan_bal = tan_bal + '$amount' WHERE id = '$member'");
    }elseif($mode == 'out'){
      $vated_amount = $amount*1.1;
      $vat = $vated_amount - $amount;
      $db->update("UPDATE mlm_members SET balance = balance - '$vated_amount' WHERE id = '$member'");
      $db->update("UPDATE mlm_users SET vat = vat + '$vat' WHERE id = 1 ");
    }

    echo "<script>window.location ='dashboard.php?success=Request Confirmed';</script>";
  }

  if(!isset($_GET['approve']) || $_GET['approve'] == '' || !isset($_GET['mode']) || $_GET['mode'] == '' ){
    echo "<script>window.location ='dashboard.php';</script>";
  }else{
    $approve = $_GET['approve'];
    $mode = $_GET['mode'];
    $request = mysqli_fetch_array($db->select("SELECT * FROM mlm_cashout WHERE id = '$approve' "));
  }
  
?>
<?php include "./inc/admin_header.php" ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Confirm Cash <?php echo $_GET['mode']; ?></h4>
                  <!-- <p class="card-category">Complete your profile</p> -->
                </div>
                <div class="card-body">
                  <form action="" method='POST'>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sent Mobile</label>
                          <input type="text" name="mobile_from" value="<?php echo $request['mobile_from']; ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <select required="1" class="form-control" name="pay_type" id="sel1">
                                  <option>Select Payment Type</option>
                                  <option <?php if($request['pay_type'] == 'bikash'){echo 'selected';}?>  value="bikash">bikash</option>
                                  <option <?php if($request['pay_type'] == 'surecash'){echo 'selected';}?> value="surecash">sure cash</option>
                                  <option <?php if($request['pay_type'] == 'rocket'){echo 'selected';}?> value="rocket">rocket</option>
                                  <option <?php if($request['pay_type'] == 'bank'){echo 'selected';}?> value="bank">bank</option>
                                  <option <?php if($request['pay_type'] == 'hand'){echo 'selected';}?> value="hand">hand to hand</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tarnsaction ID</label>
                          <input type="text" name="tan_id" value="<?php echo $request['tan_id']; ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Amount</label>
                          <input type="text" name="amount" value="<?php echo $request['amount'];  ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <input style="display: none" name="id" value="<?php echo $_GET['approve']; ?>" />
                    <input style="display: none" name="mode" value="<?php echo $_GET['mode']; ?>" />
                    <input style="display: none" name="member" value="<?php echo $request['member']; ?>" />
                    <button type="submit" class="btn btn-primary pull-right">Confirm</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
