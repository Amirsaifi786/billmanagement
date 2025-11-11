<?php require'header.php'; 

    if(isset($_GET['ided']))
    {
        $id = base64_decode($_GET['ided']);
        $status = $_GET['status'];
        $delete = mysqli_query($conn,"UPDATE product SET status = '$status' WHERE id = '$id' ");
        if($delete)
        {
           ?>
            <script>
                window.location.assign('notapprove.php');
            </script>
            <?php 
        }
        else
        {
            ?>
            <script>
                alert('Error!!! Please Try Again.');
                window.location.assign('notapprove.php');
            </script>
            <?php
        }
    }

?>

<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline !important;">Product List</h2>
            
              <a href="addbulk.php" class="btn btn-primary ml-3" style="float:right;" type="button"><i class='bx bxs-file' ></i> Add Product in Bulk(CSV File)</a>
              <a href="uploadfile.php" class="btn btn-primary ml-3" style="float:right;" type="button"><i class='bx bxs-file-archive' ></i>
 Add Images In ZIP </a>
                <a href="https://allspikes.in/admin/allspikes-csv-format.csv" download class="btn btn-secondary ml-3" style="float:right;" type="button"><i class='bx bxs-download' ></i> Format of CSV File</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Sub-Category2</th>
                            <th>Subcategory</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=1;
                                $selectproduct = mysqli_query($conn,"SELECT * FROM product WHERE status = '0' ");
                                while($fetchproduct = mysqli_fetch_array($selectproduct))
                                { 
                                    $selectsubcat2 = mysqli_query($conn,"SELECT * FROM subcategory2 WHERE id = '".$fetchproduct['subcategory2']."' ");
                                    $fetchsubcat2 = mysqli_fetch_array($selectsubcat2);
                                    
                                    $selectsubcat = mysqli_query($conn,"SELECT * FROM subcategory WHERE id = '".$fetchproduct['subcategory']."' ");
                                    $fetchsubcat = mysqli_fetch_array($selectsubcat);
                                     
                                    ?>
                          <tr>
                           
                            <td><?php echo $i; ?></td>
                            <td>
                                <?php 
                                    $image = explode(",",$fetchproduct['image']);
                                    foreach($image as $img)
                                    { 
                                ?>
                                <img src="image/<?php echo $img; ?>" width="80px">
                                
                                <?php break; } ?>
                            </td>
                            <td><?php echo $fetchproduct['name']; ?></td>
                            <td><?php echo $fetchsubcat2['name']; ?></td>
                            <td><?php echo $fetchsubcat['name']; ?></td>
                            <td><?php echo $fetchproduct['date']; ?></td>
                            <td>
                                <a class="btn btn-info" href="editproduct.php?ided=<?php echo base64_encode($fetchproduct['id']); ?>">Edit</a>
                                <a class="btn btn-danger" href="notapprove.php?ided=<?php echo base64_encode($fetchproduct['id']); ?>&status=2">Delete</a>
                                <a class="btn btn-success" href="notapprove.php?ided=<?php echo base64_encode($fetchproduct['id']); ?>&status=1">Approve</a>
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