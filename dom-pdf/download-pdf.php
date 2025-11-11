<?php
require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf; 
$dompdf = new Dompdf();
$options = $dompdf->getOptions(); 
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$fileName='content-pdf.php';
$downloadName='download-file-name-pdf';
include($fileName);
$dompdf->loadHtml($html); 
$dompdf->setPaper('A4', 'portrait'); //landscape 
$dompdf->render(); 
$dompdf->stream($downloadName, array("Attachment" => 0));	
?>