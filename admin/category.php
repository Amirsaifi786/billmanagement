<?php
    require'header.php';
    
    if(isset($_GET['cid']))
    {
        $cid = $_GET['cid'];
        $status = $_GET['status'];
      
        $delete = mysqli_query($conn,"UPDATE category SET status = '$status' WHERE id = '$cid' ");
        if($delete)
        {
            ?>
            <script>
                window.location.assign('category.php');
            </script>
            <?php
        }
        else
        {
              ?>
            <script>
                alert('Erorr! Please try again.');   window.location.assign('category.php');
            </script>
            <?php
        }
    }
?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline !important;">Category List</h2>
              <a href="addcategory.php" class="btn btn-primary ml-3" style="float:right;" type="button">Add more +</a>
               <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                  <div class="card shadow">
                    <div class="card-body">
                      <!-- table -->
                      

                      <table class="table datatables" id="dataTable-1">
                        <thead>
                          <tr>
                             
                            <th>Sr. No.</th>
                            <th>Category ID - Category Name</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <?php $select = mysqli_query($conn,"SELECT * FROM category WHERE status = '1' ");
                           $i = 1;
                           while($fetch = mysqli_fetch_array($select))
                           { ?>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetch['id']; ?> - <?php echo $fetch['name']; ?></td>
                            <td><?php echo $fetch['date']; ?></td>
                            <td>
                                <!--<a class="btn mb-2 btn-info" href="editcategory.php">Edit</a> -->
                                <a class="btn mb-2 btn-danger" href="category.php?cid=<?php echo $fetch['id']; ?>&status=2">Delete</a>
                            </td>
                            </tr>
                          <?php $i++; } ?>
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