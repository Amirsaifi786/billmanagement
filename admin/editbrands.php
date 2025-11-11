<?php
    require'header.php'; 
    
    if(isset($_GET['bid']))
    {
        $id = $_GET['bid'];
        $select = mysqli_query($conn,"SELECT * FROM brands WHERE id = '$id' ");
        $fetchdata = mysqli_fetch_array($select);
    }
    
   if(isset($_POST['submit']))
   { 
       $name = $_POST['name'];
       $img = $_FILES['image']['name'];
       $file = rand(11111,99999).$img;
        move_uploaded_file($_FILES['image']['tmp_name'],"image/$file");
       
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $date = date('d-m-Y H:i:s');
       
       if($img!='')
       {
           $insertdata = mysqli_query($conn,"UPDATE brands SET `name` = '$name',`image` = '$file', `date` = '$date' WHERE id = '$id' ");
           if($insertdata)
           {
              $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Brand updated Successfully.
                        </div>';
                 echo "<script>setTimeout(function(){ window.location = 'brands.php'; },2000);</script>";
            }
            else
            {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error! Please try again...
                        </div>';
                 echo "<script>setTimeout(function(){ window.location = 'brands.php'; },2000);</script>";
            }
       }
       else
       {
           $insertdata = mysqli_query($conn,"UPDATE brands SET `name` = '$name', `date` = '$date' WHERE id = '$id' ");
           if($insertdata)
           {
              $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Brand updated Successfully.
                        </div>';
                 echo "<script>setTimeout(function(){ window.location = 'brands.php'; },2000);</script>";
            }
            else
            {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error! Please try again...
                        </div>';
                 echo "<script>setTimeout(function(){ window.location = 'brands.php'; },2000);</script>";
            }
       }
   }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Updaate Brand</h2>
            
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">  Brands</strong>
                        <a href="brands.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i>Brand List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                         
                          <div class="col-md-6 mb-3">
                              <label for="1111">Brand Name </label>
                              <input class="form-control" id="1111" name="name" type="text" value="<?php echo $fetchdata['name']; ?>" placeholder="Brand Name">
                          </div>
                          </div>
                          <div class="form-row">
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Image </label>
                               <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="customFile">
                                    <label class="custom-file-label" for="customFile">Select Brand Images</label>
                                </div> 
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