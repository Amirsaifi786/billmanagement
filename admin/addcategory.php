<?php
require'header.php'; 

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date = date('d-m-Y H:i:s');
        
        $insert = "INSERT INTO category (`name`, `date`) VALUES ('$name','$date') ";
        $query = mysqli_query($conn,$insert);
        if($query)
        {
            $msg='<div class="alert alert-primary alert-dismissible fade show col-lg-8" role="alert">
                Success ! New Category Add Successfull..
            </div>';
             echo "<script>setTimeout(function(){ window.location = 'addcategory.php'; },2000);</script>";
        }
        else
        {
            $msg='<div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
                   Alert ! Something went wrong, please try again...
                </div>';
        }
    
    }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Category</h2>
              <!--<p class="text-muted">Provide valuable, actionable feedback to your users with HTML5 form validation</p>-->
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add Category</strong>
                        <a href="category.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i> Category List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" novalidate>
                        <div class="form-row">
                          <div class="col-md-8 mb-3">
                            <label for="validationCustom3">Category Name</label>
                            <input type="text" class="form-control" id="validationCustom3" placeholder="Enter here..." name="name" required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>  
                         <?php if(isset($msg)){echo $msg; } ?>
                        <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
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