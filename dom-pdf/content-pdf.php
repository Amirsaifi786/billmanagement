<?php
require'config.php';

$selectdata=mysqli_query($conn,"SELECT * FROM estimate_tbl WHERE status='1' ORDER BY id DESC LIMIT 1");
$fetch=mysqli_fetch_array($selectdata);
 $estimateid = $fetch['estimateid'];

$percentage = 18;
$totalWidth = $fetch['totalprice']+ $fetch['totallabour'];

$new_width = ($percentage / 100) * $totalWidth;

$totalwithgst=$new_width+$totalWidth;



$html = '<html>
<head>
<title>Total client’s G/L Summary</title>
<style>
    @page{
        margin-top: 290px; /* create space for header */
        margin-bottom: 70px; /* create space for footer */
    }
    header, footer{
        position: fixed;
        left: 0px;
        right: 0px;
    }
    header{
        height: 290px;
        margin-top: -290px;
    }
    footer{
        height: 50px;
        bottom: -50px;
      }
      main{
          margin-top:290px;
          
      }
</style>
</head>
	<body>';
		
            $html.='<style>table{width:100%;}</style>
			<header>
			<table>
			<tr><td><img src="https://trailerindia.com/assets/logo/logo.png" style="height:60px; width:160px; "></td>
			<td style="text-align:center"><div style="font-weight: bold; font-size:16px;" >TRAILER INDIA & AGRICULTURE IMPLEMENTS</div>
			<div class="divdata" style="font-size:12px;"> Hissar Road Rohtak, 124001</div>
			<div class="divdata"  style="font-size:12px;margin-top:10px">IDC Chowk Industrial Road Rohtak-124001 Ph. 9315040000 | 9215040000</div></td></tr></table>';
     
            $html.='<style>th{text-align:left; }table{font-size:13px;} </style><table >
            <tr>
                <th>Estimate No. :</th>
                <td>'.$fetch['estimateid'].'</td>
                <th>Insurance Co. & Address :</th>
                <td></td>
            </tr>
            <tr>
                <th>Date :</th>
                <td>'.$fetch['date'].'</td>
                <th>Policy No. :</th>
                <td>'.$fetch['policy'].'</td>
            </tr>
            <tr>
                <th>Reg. No. :</th>
                <td>'.$fetch['regno'].'</td>
                <th>Claim No. :</th>
                <td>'.$fetch['claim'].'</td>
            </tr>
            <tr>
                <th>Customer Name : </th>
                <td>'.$fetch['customername'].'</td>
                <th>Division No. :</th>
                <td>'.$fetch['division'].'</td>
            </tr>
            <tr>
                <th>Address : </th>
                <td>'.$fetch['address'].'</td>
                <th>Surveyor Name :</th>
                <td>'.$fetch['surveryor'].'</td>
            </tr>
            <tr>
                <th>Phone No. :</th>
                <td>'.$fetch['customerno'].'</td>
                <th>Phone : </th>
                <td>'.$fetch['phone'].'</td>
            </tr>
            
            </table>';
        $html.='<table><tr>
            <td style="text-align:center;">Subject : '.$fetch['subject'].'</td>
            </tr>
            <tr><td>Dear Sir/s,</td></tr>
            <tr><td>As desired by you we submit here in our estimate for the repair of this vehicle. </td></tr></table>';
            
        $html.='<table style="border:1px solid black; border-collapse:collapse">
        <tr>
            <th style="border:1px solid black; border-collapse:collapse">Make & Model</th>
            <th style="border:1px solid black; border-collapse:collapse">Year of menufacturer</th>
            <th style="border:1px solid black; border-collapse:collapse">Colour</th>
            <th style="border:1px solid black; border-collapse:collapse">Chassis No.</th>
            <th style="border:1px solid black; border-collapse:collapse">Kms. Covered</th>
        </tr>
        <tr>
            <td style="border-right:1px solid black;">'.$fetch['model'].'</td>
            <td style="border-right:1px solid black;">'.$fetch['yearofmenufacturar'].'</td>
            <td style="border-right:1px solid black;">'.$fetch['color'].'</td>
            <td style="border-right:1px solid black;">'.$fetch['chassisno'].'</td>
            <td style="border-right:1px solid black;">'.$fetch['km'].'</td>
        </tr>
           </table></header>';
           
        $html.='
        <footer>
            <p>Copyright &copy; '.date("Y").' TRAILER INDIA</p>
        </footer>
        <main>
		
			<table style="width:100%; border:solid thin #000; margin-top:-290px" border="1" cellspacing="0">
				<thead>
				 <tr>
                <th style="border:1px solid black; border-collapse:collapse" width="7%">Sr. No.</th>
                <th style="border:1px solid black; border-collapse:collapse"width="46%">Statement</th>
                <th style="border:1px solid black; border-collapse:collapse" width="7%">Qty</th>
                <th style="border:1px solid black; border-collapse:collapse"width="14%">Rate</th>
                <th style="border:1px solid black; border-collapse:collapse"width="14%">Material</th>
                <th style="border:1px solid black; border-collapse:collapse"width="12%">Labour</th>
            </tr>
				</thead>
				<tbody>';
					$selectdata=mysqli_query($conn,"SELECT * FROM estimate_tbl WHERE estimateid='$estimateid'");
           $itemarray=array();
           $quantityarray=array();
           $labourarray=array();
           $materialarray=array();
           $pricearray=array();
             $i=1;
             while($data=mysqli_fetch_array($selectdata))
                { 
      
                    $itemarray[0]=explode(",",substr($data[18],2,-2));
                    $quantityarray[0]=explode(",",substr($data[19],2,-2));
                    $labourarray[0]=explode(",",substr($data[22],2,-2));
                    $materialarray[0]=explode(",",substr($data[21],2,-2));
                    $pricearray[0]=explode(",",substr($data[20],2,-2));
                 
             
            
                    for($p=1; $p<=count($itemarray[0]); $p++)
                    {
               
            $html.='<tr>
                <td style="border-right:1px solid black;">'.$i.'</td>
                <td style="border-right:1px solid black;">'.str_replace("\"","",$itemarray[0][$p]).'</td>
                <td style="border-right:1px solid black;">'.str_replace("\"","",$quantityarray[0][$p]).'</td>
                <td style="border-right:1px solid black;" >'.str_replace("\"","",$pricearray[0][$p]).'</td>
                <td style="border-right:1px solid black;" >'.str_replace("\"","",$materialarray[0][$p]).'</td>
                <td style="border-right:1px solid black;" >'.str_replace("\"","",$labourarray[0][$p]).'</td>
            </tr>';
            $i++; 
            } 
                }
          
					$html.='<tr>
                <td colspan="3" style="border-right:1px solid black; border-top:1px solid black;">'.$fetch['repairday'].' will be required for repairs after confirmation </td>
                <td  style="border-right:1px solid black; border-top:1px solid black;">'.$fetch['totalprice'].' /-</td>
                <td  style="border-right:1px solid black; border-top:1px solid black;">'.$fetch['totalmaterial'].' /-</td>
                <td  style="border-right:1px solid black; border-top:1px solid black;">'.$fetch['totallabour'].' /-</td>
            </tr>
            <tr>
                <td colspan="5" style="border-right:1px solid black; border-top:1px solid black;">GST AMOUNT</td>
                <td colspan="1"  style="border-right:1px solid black; border-top:1px solid black;">'.$new_width.' /-</td>
            </tr>
            <tr>
                <td colspan="5" style="border-right:1px solid black; border-top:1px solid black;">GRAND TOTAL</td>
                <td colspan="1"  style="border-right:1px solid black; border-top:1px solid black;">'.$totalwithgst.' /-</td>
            </tr>
            <tr>
                <td colspan="3" style="border-right:1px solid black; border-top:1px solid black;">This is only an approximate estimate. We shall proceed for repairs as per conditions overleaf on your approval</td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="3" style="border-right:1px solid black; border-top:1px solid black; padding-top:30px"><span>Vehicle Checked by</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-right:30px">Service Engineer Manager</span></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="3" style="border-right:1px solid black; border-top:1px solid black; padding-top:30px"><div>Estimate Approved</div><div style="padding-top:30px"> Date : ____________________________<span>Customer Signature : </span></div></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;"></td>
                <td  style="border-right:1px solid black; border-top:1px solid black;">Subject to conditions over</td>
            </tr>
            <tr>
                <td colspan="6" style="border-right:1px solid black; border-top:1px solid black;"><div>Note : 1. This is only visual inspection estimate after dismantle. If we found any other loss, we give a seprate supplementary
                estimate.</div>
                <div>2. Price are for current specification and are subject to charge without Notice.</div></td>
                 </tr>
        
				</tbody>
			</table>
			</main>
	</body>
</html>';