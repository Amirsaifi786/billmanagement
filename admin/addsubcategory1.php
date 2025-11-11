<?php
    require'header.php'; 
    
   if(isset($_POST['submit']))
   {
       
       $category = $_POST['category'];
       $name = $_POST['name'];
       
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $date = date('d-m-Y H:i:s');
       
       $insertdata = mysqli_query($conn,"INSERT INTO subcategory (`category`, `name`, `date`) VALUES ('$category','$name','$date') ");
       if($insertdata)
       {
          $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sub-category1 added Successfully.
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addsubcategory1.php'; },1000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error! Please try again...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addsubcategory1.php'; },2000);</script>";
        }
   }
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Sub Category 1</h2>
            
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">  Sub Category 1</strong>
                        <a href="subcategory1.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i> Sub Category1 List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" novalidate>
                        <div class="form-row">
                         <div class="col-md-6 mb-4">
                             <label for="custom-select">Category</label>
                            <select class="custom-select"  name="category">
                              <option selected disabled>Select Category from this menu</option>
                                <?php 
                                  $selectcat = mysqli_query($conn,"SELECT * FROM category WHERE status = '1' ");
                                  while($fetchcat = mysqli_fetch_array($selectcat))
                                  {
                                      ?>
                                  <option value="<?php echo $fetchcat['id']; ?>"><?php echo $fetchcat['name']; ?></option>
                                    <?php
                                  } 
                                ?>
                            </select>
                         </div>
                         </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom3">Sub Category Name</label>
                            <input type="text" class="form-control" id="validationCustom3" name="name" placeholder="Enter Sub-Category Name..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                                                      
                        </div>  
                         <?php if(isset($msg)){ echo $msg; } ?>
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