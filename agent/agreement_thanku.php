<?php  include('partial/session_start.php'); ?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <?php require('partial/plugins.php'); ?>
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css"> -->

  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
  <style>
    body::-webkit-scrollbar {
      display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    body {
      -ms-overflow-style: none;  /* IE and Edge */
      scrollbar-width: none;  /* Firefox */
    }
    body{
      overflow-x: hidden;
    }

    canvas#signature {
      border: 2px solid black;
    }

    form>* {
      margin: 10px;
    }
    li,p{
      padding-bottom: 10px;
      text-align: justify;
    }
    .disable-scroll-body {
      overflow-y: hidden;
      position: relative;
    }


   li{
    padding-bottom: 10px;
    text-align: justify;
  }
  .printBtn{
    border:solid:red solid 4px;
    text-align: right;
  }


  </style>
</head>
<body>

  <?php include('partial/sidebar.php') ?>
  <div class="main_container">
    <header>
      <?php include('partial/header-top.php') ?>
    </header>
    <!-- <div class="breadcurms"> <a href="memberpage.php">Dashbord</a>  </div> -->
    <div class="breadcurms"> <a href="memberpage.php">Dashboard</a> | <a href="daily-tl-wise-report.php">Daily TL Wise Report</a> | <a href="stock-tips-report.php">Stock Tips Report</a> | <a href="employee-working-status.php">Employee Working Status</a> | <a href="management-working-status.php">Management Working Status</a></div>
    <div class="containter" style="padding:20px 20px 0 20px;">

      <div class="container pt-5">
        <div class="text-center">
          <h1 class="display-3">Thank you for submitting agreement!</h1>
          <p class="lead text-center"><strong>We have sent</strong> agreement copy to your email address.</p>
          <p class="lead text-center">Thanking You,
           <br> Stock Deal Team</p>
           <hr>
           <p class="text-center">
            Download Agreement Copy here!
          </p>
          <p class="lead text-center">
            <button class="btn btn-primary btn-sm" id="print"> Download <i class="fa fa-download"></i></button>
          </p>
        </div>
      </div>

      <div class="container">
       <div id="content_holder">
        <div id="ele1" class="a" style="display:none;">
          <h2>Customer Agreement</h2>



          <p>By visiting/Using/accessing our website (https://sharebazarexpert.com/) and/or our official
            mobile application/s and by making payment for subscription of any of our research services,
            you are agreeing to be bound by the following terms and conditbns and all other terms and
            conditions, Legal Disclaimer, Disclosures, Policies and User Agreements of Share Bazar Expert
            firm mentioned on our official website (https://sharebazarexpert.com/). We may change these
            terms and conditions and all other terms and conditions, Legal Disclaimer, Disclosures, Policies
            and User Agreements, at any time. Your continued use of our website and/or our mobile
            application and subscription to any of our research services, means that you accept any new or
            modified terms and conditions and all other terms and conditions, Legal Disclaimer, Disclosures,
            Policies and User Agreements that we come up with. Please re-visit the 'Terms and Conditions',
            'Legal Disclaimer, ‘Disclosure', 'User Agreement', 'Refund Policy' and 'Privacy Policy' links at our
            website from time to time to stay abreast of any changes that we may introduce.The tern Share
            Bazar Expert firm (https://sharemarketideas.co.in) is used through this entire document to refer
            to the website and/or our mobile application, its owners/proprietor and the employees and
            associates of the owner. The words 'You', 'Your' refers to the viewer/user/subscriber of Share
            Bazar Expert firm website/mobile application/research services.
          </p>

          <ul>
            <li>
             You hereby declare that the details provided by you at the time of subscription to our services
             are true and correct to the best of your knowledge and belief and you undertake to inform you of
             any changes therein, immediately. In case any of the above information is found to be false or
             misleading. You are aware that you may be held Liable for it.

           </li>
           <li>
             You understand and accept that trading is a risky activity that involves the risk of loss of partial
             or complete capital and that there is no guarantee of profits or returns after subscribing to any of
             Share Bazar Expert research alerts services.

           </li>
           <li>
             You understand and accept that the service provided by Share Bazar Expert is general trading
             technical analysis research and is not investment advice. The final decision to take or not to
             take any trade is completely yours. Also, the decision to trade the quantityof stocks/F&O lots to
             be traded by referring to our research reports/alerts will also be completely yours. You accept
             the entire responsibility of any gains or losses that arise out of your trading activities.

           </li>
           <li>
            You understand and agree that Share Bazar Expert firm and/or its's
            owner/proprietor/managers/employees/associates do not provide any assurance or guarantee
            of accuracy or consistency of any our research alerts/service. Any accuracy level communicated
            to the user either in written or verbal or in our advertisements/website/mobile application, is
            merely for indicative purpose only. You understand and agree that the accuracy
            level/percentage of any of our research services/alerts may vary from time to time and there is
            no commitment from Share Bazar Expert firm and/or its's
            owner/proprietodmanagers/employees/assoclates to deliver you research services/alerts with a
            fixed accuracy level/percentage.
          </li>
          <li>
           You understand that for any/all trade/s taken by you, you will be held responsible for the
           outcome of the trade/investment either resulting in gain or loss. You are willing to take complete
           responsibility for the outcome of all the trades placed in your demal account/trading account
           (Broker Account) during your tenure of the Share Bazar Expert firms research service
           subscription period.

         </li>
         <li>
          You understand that the service provided by Share Bazar Expert firm is only a research
          service and is meant only for reference. You understand and accept that the service provided by
          Share Bazar Expert firm is not an Investment Advice and all decisions to trade/invest in any
          stock/instrument is solely yours and any loss/gain that may adse out of such trades/investments
          are solely your responsibility/liability.
        </li>
        <li>
          You Agree to All Terms and Conditions, Disclosures,Disclaimers, Policies and User agreement
          of Share Bazar Expert firm and You Mow Very Well About the Risk Associated with Trading &
          Investing in the Stock Market and still you wish to subscribe to the research services of the
          Share Bazar Expert Firm. You have been informed completely about all the aspects of the
          services provided by Share Bazar Expert firm including the risks associated with trading and
          investing in the Stock Market. You confirm and agree that You have taken the subscription of
          research services of Share Bazar Expert firm after fully understanding the risks involved in
          Trading and Investing. You confirm and accept that You do not expect a fixed return or a
          guaranteed return from the research alerts service subscribed by you and you fully understand
          that you can/might lose your partial or entire capital in trading & Investing by referring to
          research services/reports/alerts of Share Bazar Expert Firm.

        </li>
        <li>
          You have mad and accepted all terms & conditions, legal disclaimer. Refund policy, Privacy
          Policy and User Agreement of Share Bazar Expert firm mentioned on our official website having
          domain name https://sharebazarexpert.com/.
        </li>
        <li>
          And You have read, understood, and accepted the risk mentioned in the disclaimer in the
          website/mobile app of Share Bazar Expert firm https://sharebazarexpert.com/.

        </li>
        <li>
          You understand and accept that Trading in the stock market is subject to market risk and You
          understand and accept that You may lose some or entire capital of yours in the stock market
          trading/investing activities, therefore, Share Bazar Expert firm or its the propdetor/owner cannot
          be held responsible for any losses in the stock market that you may incur and managing of
          trades is completely your responsibility. You confirm that You have not been asked for your
          Demat/Trading Account Login ID & Password by any of the employees/representatives of Share
          Bazar Expert Firm or anyone associated with Share Bazar Expert Firm and your Dematarading
          Account Login Credentials am not disclosed/Known to anyone except yourself.

        </li>
        <li>
          You understand and accept that You have been informed sufficiently of the risks of
          tradingAnvesting in the stock market and You have still decided to take the subscription of
          Share Bazar Expert trading research alerts services.

        </li>
        <li>
          You declare that You will be trading/investing with your own personal capital and you will not
          be tradingAnvesting with capital taken on loan or capital belonging to someone other than
          yourself.
        </li>
        <li>
          You understand and accept that because You have been informed about all the risks in
          trading/investing and have taken the subscription package of Share Bazar Expert trading
          research services/alerts, that you have to bear the loss that may arise due to your trading
          activities. You also understand and accept that You cannot claim or complaint against Share
          Bazar Expert firm or it's propdetor/owner/employees/associates I you lose money in trading or
          investing.

        </li>
        <li>
          You declare that Share Bazar Expert firm and its proprietor/Owner/employees/associates have
          not guaranteed you or assured you any retums or profits by trading and investing in the stock
          market.

        </li> <li>
          You understand and accept that Share Bazar Expert firm and its proprietor/owner
          /employees/associates do not provide any order execution services for trading/Investing
          purposes.

        </li> <li>
          You understand and accept that Amount paid to Share Bazar Expert firm are fees for providing
          you with a research alerts service and this amount is not an investment in the Stock Market itself
          and that the amount of the fee paid by you is not refundable in any conditions or circumstances.
          You Understand and accept that the fees paid by you are only for research services and that the
          Share Bazar Expert firm and its the proprietor/Owner/employees/associates will not invest any
          amount on your behalf in the stock market and you have been informed clearly about the same
          by the employees/representatives/associates of Share Bazar Expert Firm. You agree and
          accept that as you have understood and agreed to the take the risks involved in
          Trading/Investing and that any loss that might arise out of any such trading activity done by you
          whether or not by reference to Share Bazar Expert Firm research reports Of call guidance,
          hence, you accept that you cannot and will not file any legal complaint on legal notice against
          the Share Bazar Expert Firm and its proprietor/Owner/employees/associates.
        </li> <li>
          You accept that you have read all the text in this document carefully in detail and you have
          understood and accepted all the mentioned terms and conditions as well as all the terms and
          conditions including all the disclaimers, disclosures and policies mentioned in the official website
          of Share Bazar Expert firm (https://sharebazarexpert.com/). You officially accept all the terms
          and conditions laid by Share Bazar Expert firm in a digital confirmation/consent via this
          document, the confirmation/consent provided by you may act as final notification & confirmation
          and it implies that you have understood and accepted all the risks involved in the
          trading/Investing activity in stock market.

        </li> <li>
          We request you to acknowledge and confirm all the terms and conditions mentioned above in
          this document by clicking on the "Yes I Agree'. button below in this document. Share Bazar
          Expert Firm will consider these details and your consent/acceptance of all the above terms and
          conditions to be final and will be taken on an as-is basis for all our services and products which
          you may subscribe with us. On receipt or non-receipt of your confirmation to the Terms and
          Conditions of the above document, the above consent/confirmation will be considered as true
          and will be used in all our active records.
        </li>

      </ul>
      <?php 
        $id=$_GET['id'];
         $sel = "select * from agreement where id = '$id'";
          $qry = mysqli_query($connect, $sel);
          $fetch_data = mysqli_fetch_assoc($qry);

      ?>
      <form action="upload.php"  method="post">
        <label style="font-size: 20px;"><span style="font-weight: 600">Full Name: </span> <?php echo $fetch_data['full_name'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">Mobile: </span> <?php echo $fetch_data['mobile'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">Email: </span><?php echo $fetch_data['email'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">Agent Name: </span><?php echo $fetch_data['agent_name'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">Pan Number: </span> <?php echo $fetch_data['pan_number'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">Date of Birth: </span><?php echo $fetch_data['dob'];?></label>
        <br>
        <label style="font-size: 20px;"><span style="font-weight: 600">IP Address: </span><?php echo $fetch_data['ip'];?></label>
        <br>
        <label style="font-size: 20px;" class="" for=""><span style="font-weight: 600">Customer Signature: </span></label>
        <img src="user-agreement/<?php echo $fetch_data['name']; ?>" alt="Signature image">
      </form>

    </div>
    <div class="printBtn">
     <!-- <button class="btn no-print btn-success" id="print">Click to Download PDF</button> -->
   </div>
   <br>
 </div>
</div>

</div>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include('partial/footer.php') ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script> -->
<script src="user-agreement/jQuery.print.js"></script>
<script>
 $(document).ready(function(){
   $('#print').click(function(){
    $('#ele1').css('display','block');
     jQuery('#ele1').print();
     $('#ele1').css('display','none');

   });
 });

</script>