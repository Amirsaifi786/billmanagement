<?php  
require'header.php';

    $orders = mysqli_query($conn,"SELECT * FROM payment WHERE paystatus = 'Success' GROUP BY txn_id ");
    $totalorders = mysqli_num_rows($orders);
    
    // $failed = mysqli_query($conn,"SELECT * FROM payment WHERE paystatus = 'Failure' GROUP BY txn_id ");
    // $totalfailed = mysqli_num_rows($failed);
    
    $pending = mysqli_query($conn,"SELECT * FROM payment WHERE orderstatus = 'Pending' GROUP BY txn_id ");
    $totalpending = mysqli_num_rows($pending);
    
    $approved = mysqli_query($conn,"SELECT * FROM payment WHERE orderstatus = 'Approve' GROUP BY txn_id ");
    $totalapproved = mysqli_num_rows($approved);
    
    $shipped = mysqli_query($conn,"SELECT * FROM payment WHERE orderstatus = 'Shipped' GROUP BY txn_id ");
    $totalshipped = mysqli_num_rows($shipped);
    
    $delivered = mysqli_query($conn,"SELECT * FROM payment WHERE orderstatus = 'Delivered' GROUP BY txn_id ");
    $totaldelivered = mysqli_num_rows($delivered);
    
    

?>
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome Back to Admin!</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      
                    </div>
                    
                  </form>
                </div>
              </div>
              <div class="mb-2 align-items-center">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row mt-1 align-items-center">
                 
                      <div class="col-6 col-lg-2 text-center py-4 mb-2">
                        <p class="mb-1 small text-muted">Total Orders</p>
                        <span class="h3"><?php echo $totalorders; ?></span><br />
                        <!--<span class="small text-muted">+20%</span>-->
                        <!--<span class="fe fe-arrow-up text-success fe-12"></span>-->
                      </div>
                      <div class="col-6 col-lg-2 text-center py-4 mb-2">
                        <p class="mb-1 small text-muted">Pending</p>
                        <span class="h3"><?php echo $totalpending; ?></span><br />
                        <!--<span class="small text-muted">+20%</span>-->
                        <!--<span class="fe fe-arrow-up text-success fe-12"></span>-->
                      </div>
                      <div class="col-6 col-lg-2 text-center py-4 mb-2">
                        <p class="mb-1 small text-muted">Approved</p>
                        <span class="h3"><?php echo $totalapproved; ?></span><br />
                        <!--<span class="small text-muted">+6%</span>-->
                        <!--<span class="fe fe-arrow-up text-success fe-12"></span>-->
                      </div>
                      <div class="col-6 col-lg-2 text-center py-4">
                        <p class="mb-1 small text-muted">Shipped</p>
                        <span class="h3"><?php echo $totalshipped; ?></span><br />
                        <!--<span class="small text-muted">+20%</span>-->
                        <!--<span class="fe fe-arrow-up text-success fe-12"></span>-->
                      </div>
                      <div class="col-6 col-lg-2 text-center py-4">
                        <p class="mb-1 small text-muted">Delivered</p>
                        <span class="h3"><?php echo $totaldelivered; ?></span><br />
                        <!--<span class="small text-muted">-2%</span>-->
                        <!--<span class="fe fe-arrow-down text-danger fe-12"></span>-->
                      </div>
                     <!--<div class="col-6 col-lg-2 text-center py-4">-->
                     <!--   <p class="mb-1 small text-muted">Failed Orders</p>-->
                     <!--   <span class="h3"><?php echo $totalfailed; ?></span><br />-->
                        <!--<span class="small text-muted">-2%</span>-->
                        <!--<span class="fe fe-arrow-down text-danger fe-12"></span>-->
                     <!-- </div>-->
                    </div>
           
                  
                  </div> <!-- .card-body -->
                </div> <!-- .card -->
              </div>
         
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        <?php require'footer.php'; ?>