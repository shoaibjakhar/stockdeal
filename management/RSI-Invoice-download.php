<?php
error_reporting(0);
ini_set('display_errors',0);
include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");

$com ="select Company_Name from Options where Id = 1";

$qr = mysqli_query($connect, $com);

$dets = mysqli_fetch_assoc($qr);



$Brand_Color ="select Brand_Color from Options where Id = 1";

$qr_Brand_Color = mysqli_query($connect, $Brand_Color);

$dets_Brand_Color = mysqli_fetch_assoc($qr_Brand_Color);



$Invoice_Logo ="select Invoice_Logo from Options where Id = 1";

$qr_Invoice_Logo = mysqli_query($connect, $Invoice_Logo);

$dets_Invoice_Logo = mysqli_fetch_assoc($qr_Invoice_Logo);


$Invoice_Summary ="select Invoice_Summary from Options where Id = 1";

$qr_Invoice_Summary = mysqli_query($connect, $Invoice_Summary);

$dets_Invoice_Summary = mysqli_fetch_assoc($qr_Invoice_Summary);


$Office_Address ="select Office_Address from Options where Id = 1";

$qr_Office_Address = mysqli_query($connect, $Office_Address);

$dets_Office_Address = mysqli_fetch_assoc($qr_Office_Address);



$Office_Phone = "select Office_Phone from Options where Id = 1";

$qr_Office_Phone = mysqli_query($connect, $Office_Phone);

$dets_Office_Phone = mysqli_fetch_assoc($qr_Office_Phone);



$Support_Email = "select Support_Email from Options where Id = 1";

$qr_Support_Email = mysqli_query($connect, $Support_Email);

$dets_Support_Email = mysqli_fetch_assoc($qr_Support_Email);



$Company_GST = "select Company_GST from Options where Id = 1";

$qr_Company_GST = mysqli_query($connect, $Company_GST);

$dets_Company_GST = mysqli_fetch_assoc($qr_Company_GST);









$customer_id = $_GET['id'];



$sel = "select * from Customer_profile where Costumer_ID = ".$customer_id;

$qry = mysqli_query($connect, $sel);

$fetch = mysqli_fetch_assoc($qry);

$sels = "select * from Customer_Payment_History where Costumer_ID = ".$customer_id;

$qrys = mysqli_query($connect, $sels);

while($row = mysqli_fetch_assoc($qrys)){

    $fetchs[] = $row;

}

include('invoice/functions.php');
$var = '
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Untitled Document</title>

</head>



<!------ Include the above in your HEAD tag ---------->



<style>

body {

    font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";

    margin: 5px;

}

@page { margin: 5px; }

    

table tr:nth-of-type(odd) {

    background-color: rgba(0,0,0,.05);

}

.invoice {

    position: relative;

    background-color: #FFF;

    min-height: 680px;

    padding: 15px

}

.invoice header {

    padding: 10px 0;

    margin-bottom: 20px;

    border-bottom: 1px solid '.strtoupper($dets_Brand_Color['Brand_Color']).'

}

.invoice .company-details {

    text-align: right; line-height: 20px;

}

.invoice .company-details .name {

    margin-top: 0;

    margin-bottom: 10px;

}

.invoice .contacts {

    margin-bottom: 20px

}

.invoice .invoice-to {

    text-align: left

}

.invoice .invoice-to .to {

    margin-top: 0;

    margin-bottom: 0;

}

.invoice .invoice-details {

    text-align: right

}

.invoice .invoice-details .invoice-id {

    margin-top: 0;

    color: '.strtoupper($dets_Brand_Color['Brand_Color']).';

    color: '.strtoupper($dets_Brand_Color['Brand_Color']).';

    font-size: 40px;

    font-weight: normal;

}

.invoice main {

    padding-bottom: 50px

}

.invoice main .thanks {

    font-size: 2em;

    margin-bottom: 20px;

    text-align: left;

}

.invoice main .notices {

    padding-left: 16px;

    border-left: 6px solid '.strtoupper($dets_Brand_Color['Brand_Color']).';color:#777;

}

.invoice main .notices .notice {

    font-size: 16px;color:#777;

}

.lefts {

    float: left;

}

.invoice table {

    width: 100%;

    border-collapse: collapse;

    border-spacing: 0;

    margin-bottom: 20px

}

.invoice table td, .invoice table th {

    padding: 10px;

    text-align: left;

    /* background: #eee;

    border-bottom: 1px solid #fff */

}

.invoice table th {

    white-space: nowrap;

    font-weight: 400;

    font-size: 16px

}

.invoice table td h3 {

    margin: 0;

    font-weight: 400;

    color: '.strtoupper($dets_Brand_Color['Brand_Color']).';

    font-size: 1.2em

}

.invoice table .qty, .invoice table .total, .invoice table .unit {

    text-align: right;

    font-size: 1.2em

}

.invoice table .no {

    color: #fff;

    font-size: 1.6em;

    background: '.strtoupper($dets_Brand_Color['Brand_Color']).'

}

.invoice table .unit {

    background: #ddd

}

.invoice table .total {

    background: '.strtoupper($dets_Brand_Color['Brand_Color']).';

    color: #fff

}

.invoice table tbody tr:last-child td {

    border: none

}

.invoice table tfoot td {

    background: 0 0;

    border-bottom: none;

    white-space: nowrap;

    text-align: right;

    padding: 10px 20px;

    font-size: 1.2em;

    border-top: 1px solid #aaa

}

.invoice table tfoot tr:first-child td {

    border-top: none

}

.invoice table tfoot tr:last-child td {

    color: '.strtoupper($dets_Brand_Color['Brand_Color']).';

    font-size: 1.4em;

    border-top: 1px solid '.strtoupper($dets_Brand_Color['Brand_Color']).'

}

.invoice table tfoot tr td:first-child {

    border: none

}

.invoice footer {

    width: 100%;

    text-align: center;

    color: #777;

    border-top: 1px solid #aaa;

    padding: 8px 0;margin-top: 30px;

}



@media print {

.invoice {

    font-size: 11px!important;

    overflow: hidden!important

}

.invoice footer {

    position: absolute;

    bottom: 10px;

    page-break-after: always

}

.invoice>div:last-child {

    page-break-before: always

}

}

.invoice .container {

    min-width: 600px

}

    .brand-color {color:'.strtoupper($dets_Brand_Color['Brand_Color']).';}

    .brand-bg {background-color: '.strtoupper($dets_Brand_Color['Brand_Color']).' !important;color:#fff;}

    .brand-bdr {border-bottom:'.strtoupper($dets_Brand_Color['Brand_Color']).' solid 1px;}

    .font-size20 {font-size:20px;}

    .logo {width:260px;float: left;}

</style>



<body>



<!--Author      : @arboshiki-->

<div id="invoice">

  <div class="invoice overflow-auto">

    <div class="container">

      <header>

        <div class="row">

          <div class="col">

              <div class="logo">

                
               <img src="invoice/'.$dets_Invoice_Logo['Invoice_Logo'].'">

				

               </div>

          </div>

           <div class="col invoice-details">

            <h1 class="invoice-id">INVOICE</h1>

            

          </div>

        </div>

      </header>

      <main>
      

        <div class="row contacts">

          <div class="col invoice-to lefts">

               <div class="date">Date: '.date('d F Y',strtotime($fetch['SaleDate'])).'</div>

              <div class="date">Invoice Number: '.$fetch['Costumer_ID'].'</div>

              <div class="date">Package Details: '.strtoupper($fetch['PackageName']).'</div>

              <div class="date"><strong>Customer details</strong></div>

              

            <div class="text-gray-light">Name: '.$fetch['Full_Name'].'</div>

            <div class="text-gray-light">Phone: '.$fetch['Mobile_No'].'</div>

            <div class="text-gray-light">PAN: '.$fetch['Pan_Number'].'</div>

            <div class="text-gray-light">GST:';

            if(isset($fetch['GST_Number'])){

                $var .=  $fetch['GST_Number'];

            }

            $var .= ' </div>

            <div class="address"><br><br></div>

            

          </div><br>

         

            <div class="col company-details">

            <h2 class="name brand-color"> '.strtoupper($dets['Company_Name']).' </h2>

            <div>'.$dets_Office_Address['Office_Address'].'</div>

			<div>'.$dets_Office_Phone['Office_Phone'].'</div>

            <div>'.$dets_Support_Email['Support_Email'].'</div>

           <div>GST: '.$dets_Company_GST['Company_GST'].'</div>

          </div>

        </div>

        <table border="0" cellspacing="0" cellpadding="0">

          <thead>

            <tr class="brand-bg">

              <th>Sr. No.</th>

              <th class="">Payment Date</th>

              <th>Payment Mode</th>

              <th class="">Paid Amount</th>

              <th class="">Tax</th>

              <th class="">Conv fee</th>

            </tr>

          </thead>

          <tbody>

          ';

          $i = 0;

          $gross = 0;

          $tax = 0;

      foreach($fetchs as $fet){

          $i++;

          $gross +=$fet['Company_Amount'];

          $tax += $fet['Tax_Amount'];

          

          $var .= ' <tr>

              <td class="">'.$i.'</td>

              <td class="">'.date('d F Y',strtotime($fet['SaleDate'])).'</td>

              <td >'.$fet['PaymentMode'].'</td>

              <td>'.$fet['Company_Amount'].'</td>

              <td class="">'.$fet['Tax_Amount'].'</td>

              <td>0</td>

            </tr>';

            

      }  

           

           

             

            

            

          $var .= '</tbody>

        </table>

           <table border="0" style="" cellspacing="0" cellpadding="0">

          <tr>';



          $amount = $gross + $tax;



          $var .= '

     

              <td class="brand-bg">Amount In Words  </td>

              <td class="">Rs. '.getIndianCurrency($amount).'</td>

            </tr>

            

                 </table>
                   <table border="0" cellspacing="0" cellpadding="0">

          <thead>

            <tr class="brand-bg">

              <th>Customer Id</th>

              <th class="">Package</th>

              <th>Service Start Date</th>

              <th class="">Service End Date</th>

          

            </tr>

          </thead>

          <tbody>';
                 $mob = $fetch['Mobile_No'];
                 //echo $mob; 
                 
                 $sels = "select * from Customer_profile where Mobile_No =".$mob;
//echo $sels; exit;
$qrys = mysqli_query($connect, $sels);

while($row = mysqli_fetch_assoc($qrys)){
        $fetchss[] = $row;
}
                 
                  
                  if(!empty($fetchss)){
 foreach($fetchss as $fet){ 
     if(empty($fet['Activation_Date'])){
         break;
     }
   $var .= '<tr>
          <td class="">'.$fet['Costumer_ID'].'</td>
          <td class="">'.$fet['PackageName'].'</td>
      
          <td class="">'.date('d F Y',strtotime($fet['Activation_Date'])).'</td>
       
          <td class="">'.date('d F Y',strtotime($fet['Exp_Date'])).'</td>
          </tr>';
           } 
                  }
          $var .= '</tbody> </table>';
          

           $var .= '<table border="0" style="width: 300px;float:right;" cellspacing="0" cellpadding="0">

          <tr>

     

              <td class="brand-bg">SUMMARY</td>

              <td class="brand-bg">AMOUNT</td>

            </tr>

               <tr>

     

              <td class="brand-bdr">Gross Amount</td>

              <td class="brand-bdr">Rs. '.$gross.'</td>

            </tr>

            <tr class="brand-bdr">

           

              <td>GST 18%</td>

              <td>Rs. '.$tax.'</td>

            </tr>

                <tr class="brand-bdr">

           

              <td>Conv fee</td>

              <td>Rs. 0</td>

            </tr>

                



            <tr class="font-size20">

        

              <td>GRAND TOTAL</td>

              <td><strong>Rs. '.$amount.'</strong></td>

            </tr>

                 </table>

         

    

        <div class="thanks">Thank you!</div>



        <div class="notices">

           <div class="notice">
		  <li> You have given us the digital consent/confirmation via email that you accept all our terms and conditions before subscribing to this service.</li>
<li> You understand that the amount paid by you is a fee for subscription of research alerts service and not an investment in the market itself.</li> 
<li> Amount once paid is non-refundable in any conditions.</li> 
<li> Complaints either verbal/written/digital regarding refunding of any trading losses will not be entertained by us, as we have clearly communicated to you the risk involved in trading and you have accepted the disclaimers, terms and conditions via email before subscribing to this service and making payment.</li> 
<li> Please quote your invoice number in all further communications You should only refer to the alerts given in our official mobile app. Kindly download our app once you receive your login and password via email.</li> 
		  </div>

          <div class="notice">The amount once paid is not refundable.<br>Trading in stock market is a risky activity.<br>        

Please read our Terms and Conditions from time to time. </div>

        </div>

      </main>

         

        

      <footer> The Receipt is computerized hence does not required signature </footer>
      
      <div>'.$dets_Invoice_Summary['Invoice_Summary'].'</div>   
      


    </div>

    <div></div>

  </div>

</div>

<style>

  

  

  </style>

</body>

</html>';



 //echo $var;

//exit;



$dompdf->loadHtml($var);

// (Optional) Setup the paper size and orientation



$dompdf->setPaper('A4','potrait');



// Render the HTML as PDF

$dompdf->render();
//$dompdf->stream();
$dompdf->stream($fetch['Full_Name'].'-'.strtoupper($fetch['PackageName']).'-'.date('d-F-Y',strtotime($fetch['SaleDate'])).'.pdf');





