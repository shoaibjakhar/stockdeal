 <?php



//include_once('connection/dbconnection_crm.php');



	$name = $username;

	

	$result=mysqli_query($connect,"SELECT count(id) as total from Agent_request where ToWhom = '$name' AND read_bit='0'");

	$data=mysqli_fetch_assoc($result);

	

	$qrys = "select Photo from employee where username = '".$username."'";

	$getPhotoQry = mysqli_query($connect,$qrys);

	$Photos = mysqli_fetch_assoc($getPhotoQry);



?>



<div class="sidebar">

	<div class="toggle-menu"> <img src="images/menu-1.png" alt="1" title="1" id="" /></div>

<div class="profile-wrap">

 <div class="">

  <img class="img-circle" style="margin:0 auto;display:block; width:70px;" src="

		<?php 

		    if($Photos['Photo'] != '' || $Photos['Photo'] != NULL){

							    echo $Photos['Photo'];

							}

							else{

							

							echo "data:image/jpeg;base64,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";

							}

		

		?>

		

		

		" alt="">

 </div>

 <p class="text-center font-size18" style="text-transform: capitalize;"><?php  echo $username;?></p>

</div>



<ul>

	

<li><a href="memberpage.php"><img src="images/history.png" alt=""/>&nbsp;&nbsp;Follow Up Leads</a></li>

<li><a href="dashboard.php"><img src="images/Dashboard.png" alt=""/>&nbsp;&nbsp;Dashboard</a></li>

<li><a href="sales-agent-wise.php"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Agent Wise</a></li>

<!-- <li><a href="free-trail.php"><img src="images/gift.png" alt=""/>&nbsp;&nbsp;Free Trail</a></li> -->

<li><a href="customer-profile-new-this-month.php"><img src="images/customer.png" alt=""/>&nbsp;&nbsp;Paid Customers</a></li>

<li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
<li><a href="demo-stock-tips.php"><img src="images/gift.png" alt=""/>&nbsp;&nbsp;FREE Trial Stock Tips</a></li>

<!-- <li><a href="view-leads.php"><img src="images/lead.png" alt=""/>&nbsp;&nbsp;View Lead</a></li> -->

<li><a href="quality-analysis.php"><img src="images/quaility.png" alt=""/>&nbsp;&nbsp;Quality &amp; Compliance</a></li>

<li><a href="user-agreement.php"><img src="images/lock-24.png" alt=""/>&nbsp;&nbsp;User Agreement</a></li>

<li><a href="agent-request-received.php"><img src="images/send-email.png" alt=""/>&nbsp;&nbsp;Request <span class="badge badge-pill badge-info request-notification"><?php echo $data['total'];?></span></a></li>

<!-- <li><a href="send-sms-1.php"><img src="images/chat.png" alt=""/>&nbsp;&nbsp;Send SMS</a></li> -->

<?php

//print_r($_SESSION);

echo('<li><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');

		

		$sel_news_updates = "SELECT User_View from News_and_Updates";

		$qry_news_updates = mysqli_query($connect,$sel_news_updates);

		$not_seen = 0;

		

		while($row = mysqli_fetch_assoc($qry_news_updates)){

		    $user_view = (array)json_decode($row['User_View']);

		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));

		     //print_r($user_view);

		    if(!array_search($User_Id,$user_view)){

		        $not_seen+=1;

		    }

		}

		

		

		if($not_seen>0){

		    echo ('<span class="request-notification">'.$not_seen.'</span>');

		}

		

		 

		 echo '</a></li>'; 

		 

		 ?>



<li><a href="attendance.php"><img src="images/lock-24.png" alt=""/>&nbsp;&nbsp;Attendance</a></li>

<li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>&nbsp;&nbsp;Change Password</a></li>

<!--<li><a href="website-leads.php"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Website Leads</a></li>

<li><a href="#_"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Test</a></li>-->



	<?php



					$query = mysqli_query($connect, " SELECT * FROM `employee` WHERE (`username` = '" . $username . "') && (Role='Admin')");



					if ( mysql_num_rows( $query ) >= 1 ) { // if return 1, phone exist.



						//echo '1 Equity Cash';



						echo('<li><a href="demo-stock-tips.php"><img src="images/gift.png" alt=""/>&nbsp;&nbsp;Demo Stock Tips</a></li>');



					} else {



						//echo '2';



					}



					?>



</ul>

</div>







<script src="js/iidle.js"></script>



<script type="text/javascript">

setInterval(function(){
    console.log('Triggered');

//	alert("Triggered");

	///Check every 5 minuts user is in active state since 5 minutes.

	var time = "time="+"time";

  $.post("check_time.php",time);

  //Send every ogin_status Active every 1 minute 

 //$.post("update_active_status.php",time)

},60000)
//60000
</script>



<script type="text/javascript">



        $(document).ready(function(){

			

		

			

          ifvisible.setIdleDuration(1800); // Auto logout  session time in seconds

          ifvisible.on("idle", function(){

                // Stop auto updating the live data

               // console.log("Log Out");

              window.location.href="logout.php";

                });

    

		  

		 

        })







        </script>





<script>

$( document ).ready(function() {

 

	



	$(".sidebar ").hover(function(){

  $('.sidebar').stop().animate({left: 0});

  }, function(){

  $('.sidebar').stop().animate({left: -290});

});

	

	

	

	   });

	</script>

