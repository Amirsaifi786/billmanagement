<?php
    require'header.php'; 
    
    if(isset($_GET['id']))
    {
        $sid = $_GET['id'];
        $status = $_GET['status'];
      
        $delete = mysqli_query($conn,"UPDATE banner SET status = '$status' WHERE id = '$sid' ");
        if($delete)
        {
            ?>
            <script>
                window.location.assign('banner.php');
            </script>
            <?php
        }
        else
        {
              ?>
            <script>
                alert('Erorr! Please try again.');   window.location.assign('banner.php');
            </script>
            <?php
        }
    }
?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline;">Banners</h2>
                    <a href="addbanner.php" class="btn btn-primary float-right ml-3" type="button">Add more <i class="fe fe-plus fe-16"></i></a>
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
                            <th>Image</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $selecttest = mysqli_query($conn,"SELECT * FROM banner WHERE status = '1' AND type='slider'");
                          $i=1;
                          while($fetchtest = mysqli_fetch_array($selecttest))
                          { 
                              
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="image/<?php echo $fetchtest['image']; ?>" width="180px"></td>
                            <td><a href="<?php echo $fetchtest['links']; ?>" target="_blank">Click to view</a></td>
                            <td>
                                <a class="btn mb-2 btn-info" href="editbanner.php?idd=<?php echo $fetchtest['id']; ?>">Edit</a>
                                <a class="btn mb-2 btn-danger" href="banner.php?id=<?php echo $fetchtest['id']; ?>&status=2">Delete</a>
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