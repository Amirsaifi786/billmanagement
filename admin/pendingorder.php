<?php
    require'header.php'; 
    
         
    if(isset($_GET['orderid']) && isset($_GET['status']) && isset($_GET['user']))
    {
        $orderid = $_GET['orderid'];
        $status = $_GET['status'];
        $userid = $_GET['user'];
          $date = date('d-m-Y');
          
        $update = mysqli_query($conn,"UPDATE payment SET orderstatus='$status', orderstatuschangedate='$date' WHERE orderid='$orderid'");
        if($update)
        {
             $selectstatus = mysqli_query($conn,"SELECT * FROM payment WHERE orderid='$orderid'");
                $fetchstatus = mysqli_fetch_array($selectstatus);
                $orderstatus = $fetchstatus['orderstatus'];
                $orderids = $fetchstatus['txn_id'];
                
             $selectlastid = mysqli_query($conn,"SELECT * FROM users WHERE id='$userid'");
                $fetchid = mysqli_fetch_array($selectlastid);
                $email = $fetchid['email'];
                $mobile = $fetchid['mobile'];
                $name = $fetchid['name'];
                
                $to=$email;
                $subject = "Product Delivery Status";
                 $txt ="Dear $name,
    
                Order Id : $orderids
                Your Order has been $orderstatus by our team.
                we hope to see you again soon!
                justsprayonline.com";
                        
                $headers = "From: sales@justsprayonline.com" ;
                mail($to,$subject,$txt,$headers);
                
                header('location:orders.php');
                
        }
    }




?>
   <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="mb-2 page-title" style="display:inline;">Pending Orders</h2>
                    <!--<a href=".php" class="btn btn-primary float-right ml-3" type="button">Add more <i class="fe fe-plus fe-16"></i></a>-->
               <div class="row my-4">
                   
                <!-- Small table -->
                <div class="col-md-12">
                  <div class="card shadow">
                  <div class="card-header">
                       <a href="pendingorder.php" class="btn  btn-warning">Pending Orders</a>
                      <a href="approved.php" class="btn  btn-primary">Approved Orders</a>
                      <a href="shippedorder.php" class="btn  btn-secondary">Shipped Orders</a>
                      <a href="delivered.php" class="btn  btn-success">Delivered Orders</a>
                      </div>
                    <div class="card-body">
                        
                      <!-- table -->

                      <table class="table datatables" id="dataTable-1">
                            <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Order id</th> 
                                <th>Customer Name</th>
                                <th>Total Price</th> 
                                <th>Payment Status</th> 
                                <th>Order Date</th>
                                <th>Action</th> 
                                <th>Order Status</th> 
                            </tr>
                            </thead>


                            <tbody>
                                <?php
                                $i=1;
                                $selectdatatable=mysqli_query($conn,"SELECT * FROM payment WHERE paystatus='Success' AND orderstatus='Pending' GROUP BY txn_id ORDER BY date DESC ");
                                while($fetch=mysqli_fetch_array($selectdatatable))
                                {
                                    $cid=$fetch['cid']; 
                                    $sid=$fetch['sid']; 
                                    $select_query=mysqli_query($conn,"SELECT * FROM category WHERE id='$cid'");
                                    $cat=mysqli_fetch_array($select_query);
                                    
                                    $selectinfo=mysqli_query($conn,"SELECT * FROM users WHERE id='".$fetch['userid']."'");
                                    $fetchinfo=mysqli_fetch_array($selectinfo);
                                    
                                    $select_query1=mysqli_query($conn,"SELECT * FROM subcategory WHERE id='$sid'");
                                    $subcat=mysqli_fetch_array($select_query1);
                                    
                                    $tam = $fetch['txn_id'];
                                    $selectorderdat123=mysqli_query($conn,"SELECT SUM(totalprice) as totalpricewithgst FROM payment WHERE txn_id='$tam' ");
                                    $fetchnetamnt = mysqli_fetch_array($selectorderdat123);
                                ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>#<?php echo $fetch['txn_id']; ?></td>
                                <td><?php echo $fetchinfo['name']; ?></td>
                                <td>₹ <?php echo number_format($fetchnetamnt['totalpricewithgst']); ?> /-</td>
                                <td><?php echo $fetch['paystatus']; ?></td>
                                
                                
                      
                           
                                <td>    
              <?php
			echo $date=  $fetch['date'];

				
				  ?></td>
				  <td>
				        <!--<a href="vieworder.php?proid=<?php echo base64_encode($fetch['id']); ?>"><button class="btn btn-sm btn-info">View</button></a>-->
				        <a href="download-pdf.php?txn_id=<?php echo base64_encode($fetch['txn_id']); ?>"target="_blank"  ><button class="btn btn-sm btn-primary">Invoice</button></a>

				  </td>
				  <td>
				       <?php
            if($fetch['orderstatus']!='Delivered' && $fetch['orderstatus']!='Cancelled')
            {
                ?>
			    <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle"  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php if($fetch['orderstatus']=="Delivered"){ echo "Delivered"; } else { echo "Order status"; } ?>
                </a>
                
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <?php
                  if($fetch['orderstatus']=='Pending')
                  {
                      ?>
                <a class="dropdown-item" href="orders.php?orderid=<?php echo $fetch['orderid']; ?>&status=Approve&user=<?php echo $fetch['userid']; ?>">Approve</a>
                <?php   }
                  else if($fetch['orderstatus']=='Approve')
                  {
                      ?> 
                    <a class="dropdown-item" href="orders.php?orderid=<?php echo $fetch['orderid']; ?>&status=Shipped&user=<?php echo $fetch['userid']; ?>">On the way</a>
                <?php
                  }
                  else if($fetch['orderstatus']=='Shipped')
                  {
                      ?>
                    <a href="orders.php?orderid=<?php echo $fetch['orderid']; ?>&status=Delivered&user=<?php echo $fetch['userid']; ?> "class="dropdown-item">Delivered</a>
                <?php
                  }
                  ?> </div>
                </div>
                 <?php
            } 
            else
            {
                 if($fetch['orderstatus']=='Delivered'){
                     ?>
                <button class="btn btn-success" disabled>Delivered</button>
                <?php
                }
                else if($fetch['orderstatus']=='Cancelled')
                { 
                    ?>
                     <button class="btn btn-danger" disabled>Cancelled</button>
                    <?php
                }
            }
            ?>
											  </td>
                                             
                                            </tr>
                                            <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                      Are you sure you want to delete this data?
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="product.php?sid=<?php echo $fetch['id']; ?>&status=2" type="button" class="btn btn-sm btn-primary">Delete Now</a>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
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