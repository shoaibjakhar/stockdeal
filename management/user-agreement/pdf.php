<?php
namespace Dompdf;

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


$html = "<h2>sadgfdsfgdsfgs</h2>";
// print_r($dompdf);

$filename = "newpdffile";
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf(); 
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
ob_end_clean();

// $dompdf->stream("",array("Attachment" => false));
// $dompdf->stream($filename);
// die("here");
// die("skjdhfksd");
$output = $dompdf->output();

$fileName = 'document2.pdf';

file_put_contents('pdf_files/'.$fileName, $output);

//exit(0);

?>