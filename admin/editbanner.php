<?php
    require'header.php'; 
    if(isset($_GET['idd'])){
        $id=$_GET['idd'];
        $status = $_GET['status'];
        
        $sel=mysqli_query($conn, "SELECT * FROM `banner` WHERE id='$id'");
        $fet=mysqli_fetch_array($sel);  
    }
    
   if(isset($_POST['submit']))
   { 
       $links = $_POST['links'];
       $type = $_POST['type'];
       $img = $_FILES['image']['name'];
       $file = rand(11111,99999).$img;
       
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $date = date('d-m-Y H:i:s');
       
       if($img !='')
       {
        move_uploaded_file($_FILES['image']['tmp_name'],"image/$file");

       $insertdata = mysqli_query($conn,"UPDATE `banner` SET `type`='$type',`links`='$links',`image`='$img',`date`='$date' WHERE id='$id'");
       if($insertdata)
       {
          $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Banner Update Successfully.
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'sliderbanner.php'; },2000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error! Please try again...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'sliderbanner.php'; },2000);</script>";
        }
   }
  else{
       
        $insertdata = mysqli_query($conn,"UPDATE `banner` SET `type`='$type',`links`='$links',`date`='$date' WHERE id='$id'");
       if($insertdata)
       {
          $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Banner Update Successfully.
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'sliderbanner.php'; },2000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error! Please try again...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'sliderbanner.php'; },2000);</script>";
        }
   }
   }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Banner</h2>
            
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">  Banners</strong>
                        <a href="banner.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i>Banner List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                         
                          <div class="col-md-12 mb-3">
                              <label for="example-fileinput">banner type </label>
                              <select class="form-control" name="type" aria-label="Default select example">
                                  <option disabled>Open this select menu</option>
                           
                                  <option value="slider" <?php if($fet['type'] == 'slider'){
                        echo 'selected';
                    } ?>>Slider</option>
                                 <option value="banner"<?php if($fet['type'] == 'banner'){
                        echo 'selected';
                    } ?>>Banner</option>
                                </select>
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Links </label>
                              <input type="text" id="example-fileinput" name="links" value="<?php echo $fet['links']; ?>" class="form-control">
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Image </label>
                              <input type="file" id="example-fileinput" name="image" class="form-control-file">
                               <img src="image/<?php echo $fet['image']; ?>" alt="" height="100px" width="150px">
                          </div>
                        </div>  
                         <?php if(isset($msg)){ echo $msg; } ?>
                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
 
      </main>
      
      <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
      <script>
                        CKEDITOR.replace( 'description' );
                </script>
      <?php require'footer.php';  ?>