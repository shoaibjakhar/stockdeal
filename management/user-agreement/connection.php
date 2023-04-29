<?php



namespace Dompdf;
require_once 'dompdf/autoload.inc.php';

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf = new Dompdf($options); 

?>