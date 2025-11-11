<?php
    require'header.php'; 
    
    if(isset($_GET['sid']))
    {
        $sid = $_GET['sid'];
        $status = $_GET['status'];
      
        $delete = mysqli_query($conn,"UPDATE subcategory SET status = '$status' WHERE id = '$sid' ");
        if($delete)
        {
            ?>
            <script>
                window.location.assign('subcategory1.php');
            </script>
            <?php
        }
        else
        {
              ?>
            <script>
                alert('Erorr! Please try again.');   window.location.assign('subcategory1.php');
            </script>
            <?php
        }
    }
?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline;">Sub category 1 List</h2>
                    <a href="addsubcategory1.php" class="btn btn-primary float-right ml-3" type="button">Add more <i class="fe fe-plus fe-16"></i></a>
               <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                  <div class="card shadow">
                    <div class="card-body">
                      <!-- table -->

                      <table class="table datatables" id="dataTable-1">
                        <thead>
                          <tr>
                            <th>Sr.No.</th>
                            <th>Sub-category ID - Sub-category Name</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $selectsubcat = mysqli_query($conn,"SELECT * FROM subcategory WHERE status = '1' ");
                          $i=1;
                          while($fetchsubcat = mysqli_fetch_array($selectsubcat))
                          { 
                              $cat = $fetchsubcat['category'];
                              $selectcat = mysqli_query($conn,"SELECT * FROM category WHERE id = '$cat' ");
                              $fetchcat = mysqli_fetch_array($selectcat);
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetchsubcat['id']; ?> - <?php echo $fetchsubcat['name']; ?></td>
                            <td><?php if($fetchsubcat['category']==$fetchcat['id']){echo $fetchcat['name']; } ?></td>
                            <td><?php echo $fetchsubcat['date']; ?></td>
                            <td>
                                <!--<a class="btn mb-2 btn-info" href="editsubcategory1.php">Edit</a>-->
                                <a class="btn mb-2 btn-danger" href="subcategory1.php?sid=<?php echo $fetchsubcat['id']; ?>&status=2">Delete</a>
                            </td>
                            
                          </tr>
                           <?php $i++;  } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
         
      </main>
      
 <?php require'footer.php'; ?>