<?php require'header.php'; 
    
    $data = mysqli_query($conn,"SELECT * FROM admin_login WHERE id = '$user_id' ");
    $fetchdata = mysqli_fetch_array($data);

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $alternatemobile = $_POST['alternatemobile'];
        $webmail = $_POST['webmail'];
        $fb = $_POST['fb'];
        $insta = $_POST['insta'];
        $youtube = $_POST['youtube'];
        $address = $_POST['address'];
        $img = $_FILES['profile']['name'];
        $profile = rand(111111,99999).$img;
            move_uploaded_file($_FILES['profile']['tmp_name'],"image/$profile");
         
        if($img!='')  
        {
            $update = mysqli_query($conn,"UPDATE admin_login SET name = '$name',email = '$email',mobile = '$mobile',alternatemobile = '$alternatemobile',
            webmail = '$webmail',profile = '$profile',fb = '$fb',insta = '$insta',youtube = '$youtube', address = '$address' WHERE id = '$user_id' ");
            if($update)
            {
                $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Profile Update successfully...
                        </div>';
                echo "<script>setTimeout(function(){ window.location = 'index.php'; },2000);</script>";
            }
            else
            {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error!! Please try again...
                         </div>';
                echo "<script>setTimeout(function(){ window.location = 'index.php'; },2000);</script>";
            }
        }
        else
        {
            $update = mysqli_query($conn,"UPDATE admin_login SET name = '$name',email = '$email',mobile = '$mobile',alternatemobile = '$alternatemobile',
            webmail = '$webmail',fb = '$fb',insta = '$insta',youtube = '$youtube', address = '$address' WHERE id = '$user_id' ");
            if($update)
            {
                $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Profile Update successfully...
                        </div>';
                echo "<script>setTimeout(function(){ window.location = 'index.php'; },2000);</script>";
            }
            else
            {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error!! Please try again...
                         </div>';
                echo "<script>setTimeout(function(){ window.location = 'index.php'; },2000);</script>";
            } 
        }
        
    }



?>
    
    
    <main role="main" class="main-content"> 
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Admin Profile</h2>
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Profile</strong>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <?php if(isset($msg)){ echo $msg; } ?>
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Name</label>
                                <input type="text" class="form-control" id="validationCustom34" name="name"value="<?php echo $fetchdata['name']; ?>" placeholder="Enter Name" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Login Email</label>
                                <input type="text" class="form-control" id="validationCustom34" name="email"value="<?php echo $fetchdata['email']; ?>" placeholder="Enter Email" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Contact Number</label>
                                <input type="text" class="form-control" id="validationCustom34" name="mobile"value="<?php echo $fetchdata['mobile']; ?>" placeholder="Enter Contact Number" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Alternate Contact Number</label>
                                <input type="text" class="form-control" id="validationCustom34" name="alternatemobile"value="<?php echo $fetchdata['alternatemobile']; ?>" placeholder="Enter Alternate Contact Number" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Profile Image</label>
                                <input type="file" class="form-control-file" name="profile" >
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom34">Website Email</label>
                                <input type="text" class="form-control" id="validationCustom34" name="webmail" value="<?php echo $fetchdata['webmail']; ?>"placeholder="Enter Website Email" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom34">Facebook URL</label>
                                <input type="text" class="form-control" id="validationCustom34" name="fb" value="<?php echo $fetchdata['fb']; ?>"placeholder="Enter Facebook URL" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom34">Instagram URL</label>
                                <input type="text" class="form-control" id="validationCustom34" name="insta" value="<?php echo $fetchdata['insta']; ?>"placeholder="Enter Instagram URL" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom34">Youtube URL</label>
                                <input type="text" class="form-control" id="validationCustom34" name="youtube" value="<?php echo $fetchdata['youtube']; ?>"placeholder="Enter Youtube URL" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-4">
                              <label for="example-textarea">Address</label>
                              <textarea class="form-control" name="address" id="example-textarea" rows="4"><?php echo $fetchdata['address']; ?></textarea>
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

<?php require'footer.php'; ?>