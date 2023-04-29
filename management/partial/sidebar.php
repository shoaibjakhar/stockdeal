
 <?php
include_once($_SERVER['DOCUMENT_ROOT']."/connection/dbconnection_crm.php");
	 $result = mysqli_query($connect, "SELECT Sidebar_Menu_File FROM Options WHERE Id = '1'");
         $Sidebar_Menu_File = mysqli_result($result, 0);
			//echo($Sidebar_Menu_File);
			//Sidebar_Menu_File
	    ?>
<div>
<?php

$sel_ar = "SELECT COUNT(*) as cn FROM `Agent_request` WHERE TL_Status = 'Open' AND Status = 'Close' AND Team_Leader_Name = '".$_SESSION['username']."'";
$qry_ar = mysqli_query($connect, $sel_ar);
$fetch_ar = $qry_ar->fetch_assoc();
if($fetch_ar['cn']>0){
?>
<div class="alert alert-primary" role="alert" style="color: #004085; background-color: #cce5ff; border-color: #b8daff; margin-bottom: 0; text-align: center;font-weight: 800; font-size: 23px;">
 You have <a href="agent-request-received.php?filter=true" class="btn btn-md btn-success"><?php echo $fetch_ar['cn']; ?></a> Agent Request open please close
</div>
<?php
}
?>
</div>

<?php include($Sidebar_Menu_File); ?>



<?php if($_SESSION['Role'] == 'Team Leader' ||  $_SESSION['Role'] == 'compliance officer'){ 
	echo('<style> .add-customer-profile-btn,  .AddFreeTrail, .Updatebtn, .UpdateBtnAgentRequest, .agentRequestSent,  .T_L_Hide, .delete-stock-tips {display:none !important;} </style>');
		
		}?>
		
		
		
		<?php if($_SESSION['Role'] == 'compliance officer'){ 
	echo('<style> 
	
	.attendance-menu,  .add-new-transaction,  .delete_payment_history, .update_history_for_complaince {display:none !important;}
	.update_history {display:none !block;}
	
	</style>');
		
		}?>
		
		
		<?php if($_SESSION['Role'] == 'Team Leader'){ 
	echo('<style>.compliance-history-add, .Compliance-update_history {display:none !important;} 
	
	
	</style>');
		
		}?>
		
		
		
		
		
		







