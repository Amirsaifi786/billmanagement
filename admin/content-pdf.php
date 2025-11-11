<?php ob_start(); ob_flush();
require('config.php');

if(isset($_GET['txn_id']))
{
   echo $txn_id=base64_decode($_GET['txn_id']);
    
$selectdata=mysqli_query($conn,"SELECT * FROM payment WHERE txn_id='$txn_id'");
$order=mysqli_fetch_array($selectdata);


  
     $sql_pricedata=mysqli_query($conn,"SELECT   SUM(totalprice) as totalprice  , gstprice  FROM `payment` WHERE txn_id='$txn_id' ");
     $dataprice=mysqli_fetch_array($sql_pricedata);
     
$size=$order['size'];
$date=$order['date'];
     $newDate = date("m-d-Y h:i A", strtotime($date));   
 $user_id=$order['userid']; 
 $selectuser=mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
 $user=mysqli_fetch_array($selectuser);
  
 $sellprice= $order['totalprice'];
$gst=($sellprice*18)/100;
$taxable = $sellprice - $gst;

number_format($dataprice['gstprice']);
}

 



$html = '<html>
<head>
<title>All Spikes | Invoice</title>
<style>
  @page{
        margin-top: 360px; /* create space for header */
        margin-bottom: 70px; /* create space for footer */
    }
    header, footer{
        position: fixed;
        left: 0px;
        right: 0px;
    }
    header{
        height: 0px;
        margin-top: -340px; 
        
    }
    footer{
        height: 50px;
        bottom: -50px;
      }
      main{ 
          margin-top:-50px;
      }
      p, strong{
            line-height: 0.3;
      }
</style>
</head>
	<body>';
		
            $html.='<style>table{width:100%;  }</style>
			<header>
			<table style="border-bottom:2px solid black; padding:10px;">
			<tr style="font-size:14px;"><td colspan="2" style="text-align:left; font-size:17px"><b></b></td>
			<td width="50%"></td> 
			<td style="text-align:right; margin-left:-20px"><i>Original Copy</i></td> 
			 </tr>
			 
			 <tr><td><img src="https://www.webflowindia.com/all-spike/assets/images/logo.png" style="height:30px; margin-top:20px;" ></td> 
		 <td colspan="4" style="text-align:center;"><u>TAX INVOICE</u>
			  <div colspan="4" style="text-align:center; font-size:25px;"><b>ALL SPIKES</b></div> 
			   <div colspan="4" style="text-align:center;">887/33, Kath Mandi, Naya Padav, Janta Colony, Rohtak, Haryana-124001 (INDIA)</div>
			   <div colspan="4" style="text-align:center;">+91-9899085189 |   info@allspikes.com </div></td> 
			 </tr>
			 
		  </table>  ';
			
			
 $html.='<style>th{text-align:left; }table{font-size:13px;} </style>
<table style="font-size:13px">
            <tr>
                <th>Order Id   :</th>
                <td>#'.$order['txn_id'].'</td>
                
            </tr>
            <tr>
                <th>Customer Name : </th>
                <td>'.$user['name'].'</td>
                
                <th>Date & Time  :</th>
                <td>'.$newDate.'</td>
            </tr>
            <tr>
                <th>Email-id  : </th>
                <td>'.$user['email'].'</td>
                
                <th>Mobile No.  :</th>
                <td>'.$user['mobile'].'</td>
            </tr>
            <tr>
                <th>Payment Method :</th>
                <td>'.$order['paymentmethod'].' </td>
                
                <th>Pin Code   : </th>
                <td> '.$user['pincode'].'</td>
                
            </tr>
            <tr>
                <th>Payment ID :</th>
                <td>'.$order['orderid'].' </td>
                
                
            </tr>
            <tr>
                
            </tr>
           
            </table> </header>
             ';
          
            $html.=' 
             
            <table style="border-top:2px solid black; padding:10px; margin-top:-80px">
            <tr style="line-height:1.7;">
                <td width="50%" ><i><b style="font-size:15px">Sold By   :</b></i><div style="font-size:14px">887/33, Kath Mandi, Naya Padav, Janta Colony, Rohtak, Haryana-124001 (INDIA)

</div></td><br>
                <td width="50%" ><i><b style="font-size:15px">Shipped to   :</b></i><div style="font-size:14px">'.$user['address'].', '.$user['city'].', '.$user['state'].', '.$user['pincode'].'</div></td><br>
                <td width="50%" ><i><b style="font-size:15px">Billed  to   :</b></i><div style="font-size:14px">'.$user['address'].', '.$user['city'].', '.$user['state'].', '.$user['pincode'].'</div></td><br>
            </tr>
            <tr style="line-height:1.7;">
                <td><b style="font-size:15px">Mobile Number : </b> +91 98990 85189 </td> 
                <td><b style="font-size:15px">Mobile Number : </b>+91 '.$user['mobile'].' </td> 
                <td><b style="font-size:15px">Mobile Number : </b>+91 '.$user['mobile'].' </td> 
            </tr>
            <tr>
                <td><b style="font-size:15px">City / State : </b>Rohtak, Haryana-124001 </td> 
                <td><b style="font-size:15px">City / State : </b> '.$user['city'].'-'.$user['pincode'].' </td> 
                <td><b style="font-size:15px">City / State : </b> '.$user['city'].'-'.$user['pincode'].' </td> 
            </tr>
            </table>
            ';
     
          
			   $html.='<footer>
            <p>Copyright &copy; '.date("Y").' ALL SPIKES </p>
        </footer>';
          
        $html.='<main>
        <table style="width:100%; border:1px solid black; margin-top:0px;  border-collapse:collapse;  cellspacing="0">
        <thead style="  font-size:15px">
            <tr>
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="10%;">Sr. No.</th>
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="25%;">Product Name</th>
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="25%;">Size</th>
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="10%;">Qty</th> 
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="15%;">Rate</th> 
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="15%;">Gross Amount (Inc. GST)</th>
                <th style="border:1px solid black; border-collapse:collapse ;padding:8px; text-align:center;" width="15%;">Total(Rs.)</th>
            </tr>
				</thead>';
   
            $selectdata11=mysqli_query($conn,"SELECT * FROM payment WHERE txn_id='$txn_id'");
      
           $p=1;
            while($data=mysqli_fetch_array($selectdata11))
                { 
                    
                  $totalprice = $data['quantity'] * $data['price'];
                     $prdtid = $data['productid'];
                     $selectprdt=mysqli_query($conn,"SELECT * FROM product WHERE id='$prdtid'");
                     $fetch=mysqli_fetch_array($selectprdt);
                     
            $html.='<tbody><tr style=" ">
                <td style="border-right:1px solid black; border-bottom:1px solid black; font-size:17px; text-align:center; ">'.$p.'.</td>
                <td style="border-right:1px solid black; border-bottom:1px solid black; font-size:15px; padding:10px;"><b>'.$data['productname'].' </b> </td> 
                <td style="border-right:1px solid black; border-bottom:1px solid black; text-align:center; font-size:15px; padding-left:10px;">  '.$data['size'].'</td> 
                <td style="border-right:1px solid black; border-bottom:1px solid black; text-align:center;"> '.$data['quantity'].' Pcs.</td>
                <td style="border-right:1px solid black; border-bottom:1px solid black; text-align:center;" > '.number_format($data['price']).'/-</td>  
                <td style="border-right:1px solid black; border-bottom:1px solid black; text-align:center;" > '.number_format($data['quantity']*$data['price']).'/- </td> 
                <td style="border-right:1px solid black; border-bottom:1px solid black; text-align:center;" >  '.number_format($data['totalprice']).'/-</td>
            </tr>';
               $p++;
                         }
                    $html.=' 
            
            <tr>
                <td colspan="6" style="border-right:1px solid black; padding:13px; border-top:1px solid black;">Delivery Charge</td>
                <td colspan="1"  style="border-right:1px solid black; font-size:16px; border-top:1px solid black; text-align:center;"><b> 0/- </b></td>
            </tr>
            <tr>
                <td colspan="6" style="border-right:1px solid black; padding:13px; border-top:1px solid black;">GRAND TOTAL</td>
                <td colspan="1"  style="border-right:1px solid black; font-size:16px; border-top:1px solid black; text-align:center;"><b> '.number_format($dataprice['totalprice']).'/- </b></td>
            </tr>
           
        </table> 
        <br>  
             <table style="border:1px solid  black">
            
            <tr >
                <td    style="border-right:1px solid  black" width="50%">
                <h4><u>Terms & Conditions :</u></h4> 
                <p>E. & O.E.</p>
                    <div>1. Goods sold shall not be taken back.</div>
                    <div>2. Carrier Charges shall be on buyer accounts.</div>
                    <div>3. Leakage/ Damage in transit shall be on buyer account.</div> 
                </td>
                <td >    
                    <div  style="border-bottom:1px solid  black; margin-top:30px" >Receiver&#39;s Signature :</div>
                    <div style="text-align:right;"><p>For ALL SPIKES </p> 
                    <img src="" style="height:90px"><br><p style=" text-align:right;">Authorised Signature</p></div>
                </td>
                 
            </tr>
           
        </table>
        </main>';         
    
           
        
        
        $html.='</body>
</html>';

