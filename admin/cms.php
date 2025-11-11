<?php require'header.php'; 

$whereClauses = ["status = '1'"]; // Start with the existing status filter


$whereSql = implode(' AND ', $whereClauses);


?>

<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline !important;">Cms List</h2>
              <a href="addcmspages.php" class="btn btn-primary ml-3" style="float:right;" type="button">Add Pages +</a> 
               <div class="row my-4">
                <!-- Small table -->

                
                <div class="col-md-12">
                  <div class="card shadow">
                    <div class="card-body">
                  

                      <table class="table datatables" id="dataTable-1">
                        <thead>
                          <tr>
                             
                            <th>Sr. No.</th>
                            <th>Title</th>
                            <th>Status</th>                          
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=1;                       
                                $selectcms = mysqli_query($conn, "SELECT * FROM cmspages WHERE $whereSql");
                                while($cmsquery = mysqli_fetch_array($selectcms))
                                {  
                                    ?>
                          <tr>                           
                            <td><?php echo $i; ?></td>                       
                            <td><?php echo $cmsquery['title']; ?></td>                             
                            <td><?php if($cmsquery['status']==1)
                            {
                              echo 'Active';
                            }
                            else{
                              echo 'Unactive';
                              }                            
                            
                            ?>
                            
                            </td>
                            <td>
                                <a class="btn btn-info" href="editcmspages.php?ided=<?php echo base64_encode($cmsquery['id']); ?>">Edit</a>
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
        </div> 
        
        
<?php require'footer.php'; ?>