<?php
	 include($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
  //  session_start();
	$name = $_SESSION[ 'username' ];
	$result=mysqli_query($connect, "SELECT count(id) as total from Agent_request where ToWhom = 'Administrator' AND read_bit=0 ");
    $data=mysqli_fetch_assoc($result);
?>

<div class="sidebar">
<img src="images/menu-1.png" alt="1" title="1" id="" class="toggle-menu"/>
    <div class="profile-wrap">
        <div class="profile">
        </div>
        <p class="text-center font-size18" style="text-transform: capitalize;"><?php  echo $_SESSION['username'].' / '.$_SESSION['Role'];?></p>
    </div>  

    <ul style="overflow-y: auto;height: 500px;    z-index: 999;">
		 
		
		<?php
		
//	print_r($_SESSION);
		
		
if (isset($_SESSION['Role'])) {

     if($_SESSION['Role'] == 'Super Admin') {
        $cn = 0;
        $sel = "select count(*) as cn from Customer_Payment_History where Approval_Status = 'Pending'";
        $qry = mysqli_query($connect, $sel);
        $fetchs = mysqli_fetch_assoc($qry);
       $cn+= $fetchs['cn'];
       
       $sel = "select count(*) as cn from Customer_profile where Approval_Status = 'Pending'";
        $qry = mysqli_query($connect, $sel);
        $fetchs = mysqli_fetch_assoc($qry);
       $cn+= $fetchs['cn'];
        
		
echo '<li><a href="memberpage.php"><img src="images/dashboard-main.png" alt=""/>&nbsp;&nbsp;Dashboard</a></li>
        <li><a href="sales-agent-wise-all.php"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Agent Wise</a></li>
        <li><a href="sales-tl-wise-all.php"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Team Leader Wise</a></li>
        <li><a href="customer-profile-all-in-one.php"><img src="images/customer.png" alt=""/>&nbsp;&nbsp;Paid Customers <span class="badge badge-pill badge-info request-notification">'.$cn.'</span></a></li>
        <li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
        <li><a href="agent-advance-payment-details.php"><img src="images/payment.png" alt=""/>&nbsp;&nbsp;Advance Payment</a></li>
        <li><a href="agreement_list.php"><img src="images/list.png" alt=""/>&nbsp;&nbsp;Agreement List</a></li>
        <li><a href="leads-filter_4_new.php"><img src="images/lead.png" alt=""/>&nbsp;&nbsp;Assigned Leads</a></li>
       <li><a href="website-leads-rsi.php"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Website Leads';
        //<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='Administrator' and (Source='LEADSFB' or Source='Website' or Source='Direct')";
        $qry = mysqli_query($connect,$sel);
        $fetch = $qry->fetch_assoc();
        echo '<span class="request-notification">'.$fetch['cn'].'</span>';
        echo '</a></li>
        

       <li><a href="agent-request-received.php"><img src="images/support-24.png" alt=""/>&nbsp;&nbsp;Agent <span class="badge badge-pill badge-info request-notification">'.$data['total'].'</span></a></li>';
        
        
echo('<li style="display:none"><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');
				
		$sel_news_updates = "SELECT User_View from News_and_Updates";
		$qry_news_updates = mysqli_query($connect,$sel_news_updates);
		$not_seen = 0;
		
		while($row = $qry_news_updates->fetch_assoc()){
		    $user_view = (array)json_decode($row['User_View']);
		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));
		     //print_r($user_view);
		    if(!array_search($_SESSION['Id'],$user_view)){
		        $not_seen+=1;
		    }
		}
		
		
		if($not_seen>0){
		    echo ('<span class="request-notification">'.$not_seen.'</span>');
		}
		
		 
		 echo '</a></li>';        
        echo '
        <li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>Change Password</a></li>
        <li><a href="attendance.php"><img src="images/list.png" alt=""/>&nbsp;&nbsp;Attendance</a></li>
        <li><a href="agents-attendence-report.php"><img src="images/list.png" alt=""/>&nbsp;&nbsp;Agents Attendence Report</a></li>
        <li><a href="analytics-date.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>';

		
    } 
    
    else if ($_SESSION['Role'] == 'Admin Assist') {
        echo '<li><a href="memberpage.php"><img src="images/Dashboard.png" alt=""/>&nbsp;&nbsp;Dashboard</a></li>
        <li><a href="sales-agent-wise-all.php"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Agent Wise</a></li>
        <li><a href="customer-profile-all-in-one.php"><img src="images/customer.png" alt=""/>&nbsp;&nbsp;Paid Customers</a></li>
        <li><a href="leads-filter_1_new.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Filter 1</a></li>
        
        <li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
        <li class="T_L_Hide"><a href="terms-n-conditions-status.php"><img src="images/document-32.png" alt=""/>&nbsp;Terms and conditions</a></li>
        <li><a href="agent-request-received.php"><img src="images/support-24.png" alt=""/>&nbsp;&nbsp;Agent <span class="badge badge-pill badge-info request-notification">'.$data['total'].'</span></a></li>
        <li><a href="risk-profile.php"><img src="images/support-24.png" alt=""/>&nbsp;&nbsp;Risk Profile <span class="badge badge-pill badge-info request-notification"><?php echo $data["total"];?></span></a></li>';
        
        
        
        echo('<li style="display:none"><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');
				
		$sel_news_updates = "SELECT User_View from News_and_Updates";
		$qry_news_updates = mysqli_query($connect,$sel_news_updates);
		$not_seen = 0;
		
		while($row = $qry_news_updates->fetch_assoc()){
		    $user_view = (array)json_decode($row['User_View']);
		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));
		     //print_r($user_view);
		    if(!array_search($_SESSION['Id'],$user_view)){
		        $not_seen+=1;
		    }
		}
		
		
		if($not_seen>0){
		    echo ('<span class="request-notification">'.$not_seen.'</span>');
		}
		
		if($_SESSION['Role'] == 'compliance officer') {
		    echo('<li><a href="analytics-date.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>');
		    
		}
		 
		 echo '</a></li>'; 
        
        echo '<li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>Change Password</a></li>';
    }
      else if ($_SESSION['Role'] == 'SR_TL') {
        echo '<li><a href="website-leads-rsi.php"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Website Leads';
        //<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='$username'";
        $qry = mysqli_query($connect,$sel);
        $fetch = $qry->fetch_assoc();
        echo '<span class="request-notification">'.$fetch['cn'].'</span>';
        echo '</a></li>
        <li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
        <li><a href="attendance.php"><img src="images/list.png" alt=""/>&nbsp;&nbsp;Attendance</a></li>
        <li class="T_L_Hide"><a href="terms-n-conditions-status.php"><img src="images/document-32.png" alt=""/>&nbsp;Terms and conditions</a></li>
        <li><a href="sr-tl-leads-analytic.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>';
        
        // <li><a href="view-leads.php"><img src="images/lock-24.png" alt=""/>&nbsp;&nbsp;View Leads</a></li>
        
        echo('<li style="display:none"><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');
				
		$sel_news_updates = "SELECT User_View from News_and_Updates";
		$qry_news_updates = mysqli_query($connect,$sel_news_updates);
		$not_seen = 0;
		
		while($row = $qry_news_updates->fetch_assoc()){
		    $user_view = (array)json_decode($row['User_View']);
		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));
		     //print_r($user_view);
		    if(!array_search($_SESSION['Id'],$user_view)){
		        $not_seen+=1;
		    }
		}
		
		
		if($not_seen>0){
		    echo ('<span class="request-notification">'.$not_seen.'</span>');
		}
		
		if($_SESSION['Role'] == 'compliance officer') {
		    echo('<li><a href="analytics-date.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>');
		    
		}
		 
		 echo '</a></li>'; 
        
        echo '<li><a href="risk-profile.php"><img src="imagesDashboard.png" alt=""/>&nbsp;&nbsp;Risk Profile <span class="badge badge-pill badge-info request-notification"><?php echo $data["total"];?></span></a></li>
        
         <li><a href="quality-analysis.php"><img src="images/lock-24.png" alt=""/>Quality & Compliance</a></li>
        <li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>Change Password</a></li>';
    }
    else if ($_SESSION['Role'] == 'Team Leader') {
        echo '<li><a href="memberpage.php"><img src="images/Dashboard.png" alt=""/>&nbsp;&nbsp;Dashboard</a></li>
        <li><a href="sales-agent-wise.php?Team_Leader='.$username.'"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Agent Wise</a></li>
        <li><a href="customer-profile-all-in-one.php"><img src="images/customer.png" alt=""/>&nbsp;&nbsp;Paid Customers</a></li>
        <li><a href="leads-filter_1_new.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Filter 1</a></li>
        <li><a href="website-leads-rsi.php"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Website Leads';
        //<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='$username'";
        $qry = mysqli_query($connect,$sel);
        $fetch = $qry->fetch_assoc();
        echo '<span class="request-notification">'.$fetch['cn'].'</span>';
        echo '</a></li>
        <li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
        <li class="T_L_Hide"><a href="terms-n-conditions-status.php"><img src="images/document-32.png" alt=""/>&nbsp;Terms and conditions</a></li>
        <li><a href="agent-request-received.php"><img src="images/support-24.png" alt=""/>&nbsp;&nbsp;Agent <span class="badge badge-pill badge-info request-notification">'.$data['total'].'</span></a></li>
        <li><a href="tl-leads-analytic.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>';
        
        // <li><a href="view-leads.php"><img src="images/lock-24.png" alt=""/>&nbsp;&nbsp;View Leads</a></li>
        
        echo('<li style="display:none"><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');
				
		$sel_news_updates = "SELECT User_View from News_and_Updates";
		$qry_news_updates = mysqli_query($connect,$sel_news_updates);
		$not_seen = 0;
		
		while($row = $qry_news_updates->fetch_assoc()){
		    $user_view = (array)json_decode($row['User_View']);
		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));
		     //print_r($user_view);
		    if(!array_search($_SESSION['Id'],$user_view)){
		        $not_seen+=1;
		    }
		}
		
		
		if($not_seen>0){
		    echo ('<span class="request-notification">'.$not_seen.'</span>');
		}
		
		if($_SESSION['Role'] == 'compliance officer') {
		    echo('<li><a href="analytics-date.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>');
		    
		}
		 
		 echo '</a></li>'; 
        
        echo '<li><a href="risk-profile.php"><img src="imagesDashboard.png" alt=""/>&nbsp;&nbsp;Risk Profile <span class="badge badge-pill badge-info request-notification"><?php echo $data["total"];?></span></a></li>
         <li><a href="attendance.php"><img src="images/list.png" alt=""/>&nbsp;&nbsp;Attendance</a></li>
         <li><a href="quality-analysis.php"><img src="images/lock-24.png" alt=""/>Quality & Compliance</a></li>
        <li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>Change Password</a></li>';
    }
    else if ($_SESSION['Role'] == 'compliance officer') {
        echo '<li><a href="memberpage.php"><img src="images/Dashboard.png" alt=""/>&nbsp;&nbsp;Dashboard</a></li>
        <li><a href="sales-agent-wise-all.php"><img src="images/agent.png" alt=""/>&nbsp;&nbsp;Sales Agent Wise</a></li>
        <li><a href="customer-profile-all-in-one.php"><img src="images/customer.png" alt=""/>&nbsp;&nbsp;Paid Customers</a></li>
        <li><a href="leads-filter_1_new.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Filter 1</a></li>
        <li><a href="website-leads-rsi.php"><img src="images/globe.png" alt=""/>&nbsp;&nbsp;Website Leads';
        //<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='$username'";
        $qry = mysqli_query($connect,$sel);
        $fetch = $qry->fetch_assoc();
        echo '<span class="request-notification">'.$fetch['cn'].'</span>';
        echo '</a></li>
        <li><a href="stock-tips.php"><img src="images/research.png" alt=""/>&nbsp;&nbsp;Stock Tips</a></li>
        <li class="T_L_Hide"><a href="terms-n-conditions-status.php"><img src="images/document-32.png" alt=""/>&nbsp;Terms and conditions</a></li>
        <li><a href="agent-request-received.php"><img src="images/support-24.png" alt=""/>&nbsp;&nbsp;Agent <span class="badge badge-pill badge-info request-notification">'.$data['total'].'</span></a></li>';
        
        
        
        echo('<li style="display:none;"><a href="news-and-updates.php"><img src="assests/Images/icon5.png" alt=""> News and Updates');
				
		$sel_news_updates = "SELECT User_View from News_and_Updates";
		$qry_news_updates = mysqli_query($connect,$sel_news_updates);
		$not_seen = 0;
		
		while($row = $qry_news_updates->fetch_assoc()){
		    $user_view = (array)json_decode($row['User_View']);
		     //$user_view = array_combine(range(1, count($user_view)), array_values($user_view));
		     //print_r($user_view);
		    if(!array_search($_SESSION['Id'],$user_view)){
		        $not_seen+=1;
		    }
		}
		
		
		if($not_seen>0){
		    echo ('<span class="request-notification">'.$not_seen.'</span>');
		}
		
		if($_SESSION['Role'] == 'compliance officer') {
		    echo('<li><a href="analytics-date.php"><img src="images/analytics.png" alt=""/>&nbsp;&nbsp;Analytics</a></li>');
		    
		}
		 
		 echo '</a></li>'; 
        
        echo '<li><a href="risk-profile.php"><img src="imagesDashboard.png" alt=""/>&nbsp;&nbsp;Risk Profile <span class="badge badge-pill badge-info request-notification"><?php echo $data["total"];?></span></a></li>
         <li><a href="quality-analysis.php"><img src="images/lock-24.png" alt=""/>Quality & Compliance</a></li>
        <li><a href="change-password.php"><img src="images/lock-24.png" alt=""/>Change Password</a></li>';
    }
}

?>
		
		
		
        
    </ul>
</div>
<script>
$(document).ready(function() {
 	
/*********************************************************/
/******** Sidebar toggoe menu ************************/	
/********************************************************/	

$(".sidebar ").hover(function(){
  $('.sidebar').stop().animate({left: -0});
  }, function(){
  $('.sidebar').stop().animate({left: -290});
});
	
	
	
	   });
	</script>