<?php include "./inc/head.php" ?>
<?php

  $mode  = $_GET['mode'];

  if($_GET['mode'] === 'Update' && is_numeric($_GET['id']) === true){
    $id = $_GET['id'];
    $sql = "SELECT * FROM mlm_packages WHERE id = '$id' LIMIT 1 ";
    $result = $db->select($sql);
    if ($result != false) {
      $value = mysqli_fetch_array($result);
    }
  }
?>
<?php include "./inc/admin_header.php" ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><?php echo $_GET['mode']; ?> Package</h4>
                  <!-- <p class="card-category">Complete your profile</p> -->
                </div>
                <div class="card-body">
                  <form action="./functions/package.php" method='POST'>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Package Name</label>
                          <input type="text" name="name" value="<?php if($mode === 'Update'){ echo $value['name']; } ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Price</label>
                          <input type="text" name="price" value="<?php if($mode === 'Update'){ echo $value['price']; } ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Stock</label>
                          <input type="text" name="stock" value="<?php if($mode === 'Update'){ echo $value['stock']; } ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Details</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Add Details</label>
                            <textarea name="details" class="form-control" rows="5"><?php if($mode === 'Update'){ echo $value['details']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input style="display: none" name="mode" value="<?php echo $_GET['mode']; ?>">
                    <?php
                      if($_GET['mode'] === 'Update' && is_numeric($_GET['id']) === true ){
                    ?>
                    <input style="display: none" name="id" value="<?php echo $_GET['id']; ?>">
                    <?php
                      }
                    ?>
                    <button type="submit" class="btn btn-primary pull-right"><?php echo $mode; ?> Package</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "./inc/admin_footer.php" ?>
