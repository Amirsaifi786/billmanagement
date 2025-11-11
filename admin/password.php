<?php
require'header.php';    
    
    if(isset($_POST['submit']))
    {
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $cpass = $_POST['cpass'];
        
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date =  date('d-m-Y H:i:s');
        
        $checkpass = mysqli_query($conn,"SELECT * FROM admin_login WHERE password = '$oldpass' AND id = '$user_id' ");
        
        if(mysqli_num_rows($checkpass)>0)
        {
            if($newpass != $cpass)
            {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Confirm password and New password doesn<q>t match.
                     </div>';echo "<script>setTimeout(function(){ window.location = 'password.php'; },2000);</script>";
            }
            else
            {
                $updatepass = mysqli_query($conn,"UPDATE admin_login SET password = '$newpass' WHERE id = '$user_id' ");
                if($updatepass)
                {
                      $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                                Password Changed successfully...
                            </div>';
                     echo "<script>setTimeout(function(){ window.location = 'password.php'; },2000);</script>";
                }
                else
                {
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error!! Please try again...
                             </div>';
                     echo "<script>setTimeout(function(){ window.location = 'password.php'; },2000);</script>";
                }
            }
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Old password is incorrect.
                     </div>';echo "<script>setTimeout(function(){ window.location = 'password.php'; },2000);</script>";
        }
       
        
    }

?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Manage Password</h2>
              <!--<p class="text-muted">Provide valuable, actionable feedback to your users with HTML5 form validation</p>-->
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Change Password</strong>
                        <!--<a href="" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i> Sub Category2 List</a>-->

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" novalidate>
                       
                        <span class="col-md-9"> <?php if(isset($msg)){ echo $msg; } ?></span>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom">Current Password</label>
                            <input type="text" class="form-control" id="validationCustom" name="oldpass" placeholder="Enter Current Password Here..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div> 
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom0">New Password</label>
                            <input type="text" class="form-control" id="validationCustom0" name="newpass" placeholder="Enter New Password Here..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div> 
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom1">Confirm Password</label>
                            <input type="text" class="form-control" id="validationCustom1" name="cpass" placeholder="Enter Confirm Password Here..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div> 
                     
                        <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
 
      </main>

      
      <?php require'footer.php';  ?>