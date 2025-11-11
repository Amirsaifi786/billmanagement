<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require'config.php';    
    
    if(isset($_POST['submit']))
    {
        $rating = $_POST['rating'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $subcategory2 = $_POST['subcategory2']; 
        $size = $_POST['size'];
        $stock = $_POST['stock'];
        $mrp = $_POST['mrp'];
        $sellprice = $_POST['sellprice'];
        $gender = $_POST['gender'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $specification = $_POST['specification'];
         
        
        if(count($_FILES['gallery']['name']) > 0)
        {
            for($i=0; $i<count($_FILES['gallery']['name']); $i++)
            {
                $tmpFilePath = $_FILES['gallery']['tmp_name'][$i];
    
                if($tmpFilePath != "")
                {
                
                    $shortname = $_FILES['gallery']['name'][$i];
    
                    $filePath = $_FILES['gallery']['name'][$i];
    
                    if(move_uploaded_file($tmpFilePath, "image/$filePath"))
                    {
    
                        $var[] = $filePath;
    
                    }
                }
            }
    
            $v = implode(',',$var);
           
        }
 
        
 
     
    $sizee = implode(',', $size);
    $stockk = implode(',', $stock);
     
     
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date =  date('d-m-Y H:i:s');
         
        $insertsubcat2 = mysqli_query($conn,"INSERT INTO `product`(`category`,`rating`, `subcategory`, `subcategory2`, `name`, `image`, `gender`, `mrp`, `sellprice`,
        `size`,`stock`, `title`, `description`, `specification`, `date`) VALUES ('$category','$rating','$subcategory','$subcategory2','$name','$v', '$gender', '$mrp',
        '$sellprice','$sizee','$stockk','$title','$description','$specification','$date')");
        if($insertsubcat2)
        {
              $msg = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Product added successfully...
                    </div>';
             echo "<script>setTimeout(function(){ window.location = 'addproduct.php'; },1000);</script>";
        }
        else
        {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error!! Please try again...
                     </div>';
             echo "<script>setTimeout(function(){ window.location = 'addproduct.php'; },2000);</script>";
        }
        
} 
require'header.php';   
?>
 <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Add Product</h2>
              <!--<p class="text-muted">Provide valuable, actionable feedback to your users with HTML5 form validation</p>-->
              <div class="row">
        
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add Product</strong>
                        <a href="products.php" class="btn btn-primary float-right ml-3" type="button"><i class="fe fe-arrow-left "></i>Product List</a>

                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <?php if(isset($msg)){ echo $msg; } ?>
                        <div class="form-row">
                         <div class="col-md-4 mb-4">
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
                         <div class="col-md-4 mb-4">
                             <label for="custom-select">Sub-Category1</label>
                            <select class="custom-select"  name="subcategory" id="subcategory">
                              <option selected disabled>Select Category from above menu</option>
                               
                            </select>
                         </div>
                         <div class="col-md-4 mb-4">
                             <label for="custom-select">Sub-Category2</label>
                            <select class="custom-select"  name="subcategory2" id="subcategory2">
                              <option selected disabled>Select Sub-Category from above menu</option>
                               
                            </select>
                         </div> 
                        </div>
                        <div class="form-row">
                         
                          <div class="col-md-4 mb-3">
                            <label for="validationCustom34">Product Name</label>
                            <input type="text" class="form-control" id="validationCustom34" name="name" placeholder="Enter Product Name Here..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="validationCustom34">Rating</label>
                            <input type="text" class="form-control" id="validationCustom34" name="rating" placeholder="Enter Product Rating Here..." required>
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                         <div class="col-md-4 mb-4">
                             <label for="custom-select">Type</label>
                            <select class="custom-select"  name="gender" id="gender">
                              <option selected disabled>Select Type</option>
                               <option value="male">Male</option>
                               <option value="female">Female</option>
                            </select>
                         </div> 
                        </div>  
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                              <label for="customFile">Product Images</label>
                               <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="gallery[]" multiple required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                               
                            </div>
                         
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="mrp">MRP</label>
                                    <input type="text" class="form-control" id="mrp" name="mrp" placeholder="Enter MRP" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sellprice">Selling Price</label>
                                    <input type="text" class="form-control" id="sellprice" name="sellprice" placeholder="Enter Sell Price" required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>
                        
                          <div class="form-row">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                             <td><input type="text" class="form-control" id="validationCustom01"
                                            name="size[]" placeholder="Size"  ></td>
                                             <td><input type="text" class="form-control" id="validationCustom01"
                                            name="stock[]" placeholder="Stock"  ></td>
                            
                                            <td><button class="btn btn-md btn-primary" 
                                      id="addBtn" type="button" >
                                        Add new Row
                                    </button></td>
                                          </tr>
                                        </thead>
                                        <tbody id="tbody">
                                  
                                        </tbody>
                                      </table>
                                 </div>
                             
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Title Description</label>
                                    <textarea class="form-control" name="title" id="editor1"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="example-textarea">Specification</label>
                                    <textarea class="form-control" name="specification" id="specification" rows="4"></textarea>
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
      <!-------------------------------------------------CK EDITOR-------------------------------------------------->
      <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
        
        <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
        <script>
                        CKEDITOR.replace( 'description' );
                </script>
        <script>
                        CKEDITOR.replace( 'specification' );
                </script>
        
    <!---------------------------------------------------CK EDITOR--------------------------------------------------->

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
       
        <script>
        $(document).ready(function(){
        
            $('#subcategory').on("change",function () {
                var categoryId2 = $(this).find('option:selected').val();
                 $.ajax({
                    url: "ajax2.php",
                    type: "POST",
                    data: {categoryId2:categoryId2},
                    cache:false,
                    success: function (response) {
                         
                        $("#subcategory2").html(response);
                    },
                });
            }); 
        
        });
        </script>
            
            <script>
            $(document).ready(function () {
          
              // Denotes total number of rows
              var rowIdx = 0;
          
              // jQuery button click event to add a row
              $('#addBtn').on('click', function () {
          
                // Adding a row inside the tbody.
                $('#tbody').append(`<tr id="R${++rowIdx}">
                     <td><input type="text" class="form-control" id="validationCustom01"
                       name="size[]"  placeholder="Size"></td>
                     <td><input type="text" class="form-control" id="validationCustom01"
                                            name="stock[]" placeholder="Stock" required></td>
                 
                      <td class="text-center">
                        <button class="btn btn-danger remove"
                          type="button" style="float:left !important;">Remove</button>
                        </td>
                      </tr>`);
              });
          
              // jQuery button click event to remove a row.
              $('#tbody').on('click', '.remove', function () {
         
                // Getting all the rows next to the row
                // containing the clicked button
                var child = $(this).closest('tr').nextAll();
          
                // Iterating across all the rows 
                // obtained to change the index
                child.each(function () {
          
                  // Getting <tr> id.
                  var id = $(this).attr('id');
          
                  // Getting the <p> inside the .row-index class.
                  var idx = $(this).children('.row-index').children('p');
          
                  // Gets the row number from <tr> id.
                  var dig = parseInt(id.substring(1));
          
                  // Modifying row index.
                  idx.html(`Row ${dig - 1}`);
          
                  // Modifying row id.
                  $(this).attr('id', `R${dig - 1}`);
                });
          
                // Removing the current row.
                $(this).closest('tr').remove();
          
                // Decreasing total number of rows by 1.
                rowIdx--;
              });
            });
          </script>
      
      <?php require'footer.php';  ?>