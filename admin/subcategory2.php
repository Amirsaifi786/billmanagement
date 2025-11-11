<?php
    require'header.php'; 

     if(isset($_GET['sid']))
    {
        $sid = $_GET['sid'];
        $status = $_GET['status'];
      
        $delete = mysqli_query($conn,"UPDATE subcategory2 SET status = '$status' WHERE id = '$sid' ");
        if($delete)
        {
            ?>
            <script>
                window.location.assign('subcategory2.php');
            </script>
            <?php
        }
        else
        {
              ?>
            <script>
                alert('Erorr! Please try again.');   window.location.assign('subcategory2.php');
            </script>
            <?php
        }
    }

?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline;">Sub category-2 List</h2>
                      <a href="addsubcategory2.php" class="btn btn-primary float-right ml-3" type="button">Add more <i class="fe fe-plus fe-16"></i></a>
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
                            <th>Sub-category ID - Sub-category 2 Name</th>
                            <th>Sub-category Name</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $selectsubcat2 = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE status = '1' ");
                          $i=1;
                          while($fetchsubcat2 = mysqli_fetch_array($selectsubcat2))
                          { 
                              $cat = $fetchsubcat2['category'];
                              $selectcat = mysqli_query($conn,"SELECT * FROM category WHERE id = '$cat' ");
                              $fetchcat = mysqli_fetch_array($selectcat);
                              
                              $subcat = $fetchsubcat2['subcategory'];
                              $selectsubcat = mysqli_query($conn,"SELECT * FROM subcategory WHERE id = '$subcat' ");
                              $fetchsubcat = mysqli_fetch_array($selectsubcat);
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetchsubcat2['id']; ?> - <?php echo $fetchsubcat2['name']; ?></td>
                            <td><?php if($fetchsubcat2['subcategory']==$fetchsubcat['id']){echo $fetchsubcat['name']; } ?></td>
                            <td><?php if($fetchsubcat2['category']==$fetchcat['id']){echo $fetchcat['name']; } ?></td>
                            <td><?php echo $fetchsubcat2['date']; ?></td>
                            <td>
                                <!--<a class="btn mb-2 btn-info" href="editsubcategory1.php">Edit</a>-->
                                <a class="btn mb-2 btn-danger" href="subcategory2.php?sid=<?php echo $fetchsubcat2['id']; ?>&status=2">Delete</a>
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