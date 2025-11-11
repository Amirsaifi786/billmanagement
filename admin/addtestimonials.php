<?php
    require'header.php'; 
    
   if(isset($_POST['submit']))
   { 
       $name = $_POST['name'];
       $description = $_POST['description'];
       $img = $_FILES['image']['name'];
       $file = rand(11111,99999).$img;
        move_uploaded_file($_FILES['image']['tmp_name'],"image/$file");
       
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $date = date('d-m-Y H:i:s');
       
       $insertdata = mysqli_query($conn,"INSERT INTO testimonials ( `name`, `image`, `description`, `date`) VALUES ('$name','$file','$description','$date') ");
       if($insertdata)
       {
          $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Testimonial added Successfully.
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addtestimonials.php'; },1000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error! Please try again...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addtestimonials.php'; },2000);</script>";
        }
   }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Testimonials</h2>
            
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">  Testimonials</strong>
                        <a href="subcategory1.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i>Testimonials List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                         <div class="col-md-6 mb-4">
                             <label for="custom-select">Name</label>
                             <input type="text" class="form-control" id="custom-select" name="name" placeholder="Enter Name" required>
                             <div class="valid-feedback"> Looks good! </div>
                         </div> 
                          <div class="col-md-6 mb-3">
                              <label for="example-fileinput">Image </label>
                              <input type="file" id="example-fileinput" name="image" class="form-control-file">
                          </div>
                        </div>  
                         <div class="form-row">
                          <div class="col-md-12 mb-3">
                              <label for="example-textarea">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
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