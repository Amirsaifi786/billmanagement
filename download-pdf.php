<?php
require_once 'dom-pdf/dompdf/autoload.inc.php'; 


use Dompdf\Dompdf; 
$dompdf = new Dompdf();
$canvas = $dompdf->get_canvas();
$options = $dompdf->getOptions(); 
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$fileName='content-pdf.php';
$downloadName='Invoice('.(date('d-m-Y')).')';
include($fileName);
$dompdf->loadHtml("$html"); 
$dompdf->setPaper('A4', 'portrait'); //landscape 
$dompdf->render(); 
$dompdf->stream($downloadName, array("Attachment" => 0));
 




?>
