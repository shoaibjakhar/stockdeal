<?php
//assests/Documents/Upload-leads.csv
$filename = 'Upload-Leads.csv';
$contenttype = "application/force-download";
header("Content-Type: " . $contenttype);
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
readfile("assests/Documents/".$filename);

?>