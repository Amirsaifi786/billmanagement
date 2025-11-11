<?php
require('config.php');

 $start=$_POST['start'];
   
 $sel_data="SELECT * FROM product WHERE status='1' AND name ='$start' ";
 
        $select_nblnc=mysqli_query($conn,$sel_data);
         
        $num=mysqli_num_rows($select_nblnc);
    if($num>0)
    {
         
            foreach($select_nblnc as $data)
             {
                  $saveamount=$data['mrp'] - $data['sellprice'];
                    $countper = $saveamount/$data['mrp'];
                    $lastpercent = $countper*100;
                        $msg = '
                      
                      <div class="col-lg-4 col-md-6 col-6">
						 
                            <a href="product-details.php?idpro='.base64_encode($data['id']).'">
                              <div class="product-item products">
                                  <div class="product-thumb">';
                                      
                                        $image = explode(",",$data['image']);
                                        foreach($image as $img)
                                        {  
                                      $msg.='<img src="admin/image/'.$img.'" alt="product thumb">';
                                      break; }  
                            $msg.='        
                                  </div>
                                  <div class="product-content">
                                      <div class="name">
                                          <h2>'; 
                                                $text=$data['name'];
                                                 $pieces = substr($text, 0, 20);  
                            $msg.='  '.$pieces.'     </h2>
                                      </div>
                                      <div class="price">
                                          <div>
                                            <span class="sale">&#8377 '.$data['sellprice'].'.00</span>
                                            <span class="real">&#8377 '.$data['mrp'].'.00</span>
                                          </div>
                                      </div>';
                                      
                                             $saveamount=$data['mrp'] - $data['sellprice'];
                                            $countper = $saveamount/$data['mrp'];
                                            $lastpercent = $countper*100;  
                            $msg .='<div class="delivery">
                                          <h4>Flat '.ceil($lastpercent).'% Off</h4>
                                      </div>
                                  </div>    
                              </div>
                            </a>
                            <!-- product single item end -->
					</div>
		
                    
				 	 ';
            }
        
        
        
}
else
{ 
 $msg = '<div class="container">
                <div class="row content-justify-center">
                    <div class="col-lg-12 col-md-6" style="padding:100px">
                        <div class="card mt-2">
                          <div class="card-body">
                          <span style="text-align:center; ">No Data Found</span>
                                 </div>
                        </div>
                    </div>
                </div>
            </div>';
}
 
   echo $msg;

?>