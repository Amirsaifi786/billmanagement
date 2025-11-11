<?php
    require'header.php'; 
    
    if(isset($_GET['sid']))
    {
        $sid = $_GET['sid'];
        $status = $_GET['status'];
      
        $delete = mysqli_query($conn,"UPDATE testimonial SET status = '$status' WHERE id = '$sid' ");
        if($delete)
        {
            ?>
            <script>
                window.location.assign('testimonials.php');
            </script>
            <?php
        }
        else
        {
              ?>
            <script>
                alert('Erorr! Please try again.');   window.location.assign('testimonials.php');
            </script>
            <?php
        }
    }
?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline;">Testimonials List</h2>
                    <a href="addtestimonials.php" class="btn btn-primary float-right ml-3" type="button">Add more <i class="fe fe-plus fe-16"></i></a>
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
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $selecttest = mysqli_query($conn,"SELECT * FROM testimonials WHERE status = '1' ");
                          $i=1;
                          while($fetchtest = mysqli_fetch_array($selecttest))
                          { 
                              
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetchtest['name']; ?></td>
                            <td><img src="image/<?php echo $fetchtest['image']; ?>" width="80px"></td>
                            <td><?php echo $fetchtest['description']; ?></td>
                            <td>
                                <a class="btn mb-2 btn-info" href="edittestimonials.php">Edit</a>
                                <a class="btn mb-2 btn-danger" href="testimonials.php?sid=<?php echo $fetchtest['id']; ?>&status=2">Delete</a>
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