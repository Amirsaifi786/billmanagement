<?php
require'header.php';    
    
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $subcategory = $_POST['subcategory'];
        $category = $_POST['category'];
        
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date =  date('d-m-Y H:i:s');
        
        $insertsubcat2 = mysqli_query($conn,"INSERT INTO subcategory2 (`name`,`subcategory`,`category`,`date`) VALUES ('$name','$subcategory','$category','$date')");
        if($insertsubcat2)
        {
              $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Sub-category2 added successfully...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addsubcategory2.php'; },1000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error!! Please try again...
                     </div>';
             echo "<script>setTimeout(function(){ window.location = 'addsubcategory2.php'; },2000);</script>";
        }
        
    }

?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Sub Category 2</h2>
              <!--<p class="text-muted">Provide valuable, actionable feedback to your users with HTML5 form validation</p>-->
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add  Sub Category2</strong>
                        <a href="subcategory2.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i> Sub Category2 List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" novalidate>
                        <?php if(isset($msg)){ echo $msg; } ?>
                        <div class="form-row">
                         <div class="col-md-6 mb-4">
                             <label for="custom-select">Category</label>
                            <select class="custom-select"  name="category" id="category">
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
                         <div class="col-md-6 mb-4">
                             <label for="custom-select">Sub-Category1</label>
                            <select class="custom-select"  name="subcategory" id="subcategory">
                              <option selected disabled>Select Category from above menu</option>
                               
                            </select>
                         </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom3">Sub-Category2 Name</label>
                            <input type="text" class="form-control" id="validationCustom3" name="name" placeholder="Enter Sub-category2 Here..." required>
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
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
        
        
        <script>
        $(document).ready(function(){
        
            $('#category').on("change",function () {
                var categoryId = $(this).find('option:selected').val();
                 $.ajax({
                    url: "ajax.php",
                    type: "POST",
                    data: {categoryId:categoryId},
                    cache:false,
                    success: function (response) {
                         
                        $("#subcategory").html(response);
                    },
                });
            }); 
        
        });
        </script>
      
      <?php require'footer.php';  ?>