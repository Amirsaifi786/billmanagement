<?php
    require'header.php'; 
    
   if(isset($_POST['submit']))
   { 
       $links = $_POST['links'];
       $type = $_POST['type'];
       $img = $_FILES['image']['name'];
       $file = rand(11111,99999).$img;
        move_uploaded_file($_FILES['image']['tmp_name'],"image/$file");
       
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $date = date('d-m-Y H:i:s');
       
       $insertdata = mysqli_query($conn,"INSERT INTO banner ( `links`,`type`,`image`, `date`) VALUES ('$links','$type','$file','$date') ");
       if($insertdata)
       {
          $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Banner added Successfully.
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'banner.php'; },2000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error! Please try again...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'banner.php'; },2000);</script>";
        }
   }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Banner</h2>
            
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
                                  <option selected>Open this select menu</option>
                                  <option value="slider">Slider</option>
                                  <option value="banner">Banner</option> 
                                </select>
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Links </label>
                              <input type="text" id="example-fileinput" name="links" class="form-control">
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Image </label>
                              <input type="file" id="example-fileinput" name="image" class="form-control-file">
                          </div>
                        </div>  
                         <?php if(isset($msg)){ echo $msg; } ?>
                        <button class="btn btn-primary" type="submit" name="submit">Add</button>
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