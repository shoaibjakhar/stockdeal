<?php  include('partial/session_start.php'); ?>
<?php
//$username;
//session_start();
 //$username = $username;
 //echo $username;

//include('partial/validate-user.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Follow Up Leads</title>
<?php require('partial/plugins.php'); ?>
<?php 
//<span class="request-notification">'.$not_seen.'</span>
        $sel = "select count(*) as cn FROM `Assigned_Leads` WHERE Disposition='Fresh' and UserName ='$username' and (Source='LEADSFB' or Source='Website' or Source='Direct')";
        $qry = mysqli_query($connect,$sel);
        $fetch = mysqli_fetch_assoc($qry);
        //echo($sel);
       // echo '<span class="request-notification">'.$fetch['cn'].'</span>';

?>
<style>

.duplicate {
    background:#ec7b7b;
		color:#fff;
}


	
</style>
</head>
<body>


 <?php include('partial/sidebar.php') ?>

<div class="main_container">
<header>
  <?php include('partial/header-top.php') ?>
  
</header>
<div class="breadcurms">
 <a href="memberpage.php">Follow Up Leads</a> | <a href="follow-up-leads-filter-2.php" >Filter 2</a> | <a href="fresh-leads.php" class="btn btn-xs btn-primary">Fresh Leads </a> <span class="badge badge-pill badge-info request-notification" style="background: #5D78FF;color: #fff;margin-left: 0;"><?php echo $fetch['cn'];?></span> | <a href="lead-details-filter2-new.php">Filter 1</a> | <a href="leads-view.php">Add New Leads</a> 
</div>

<div class="containter" style="padding:5px 20px 0 20px">
 <?php //include('connection/dbconnection_crm.php')?>

<div class="clearfix"></div>

<h3 style="padding:10px;font-size:18px;" class="brand-color-bg-n-bdr">Fresh Leads <div class="pull-right"><span id="totalRecord"></span>  Records</div></h3>
<div style="width:100%; overflow:auto;">

<?php
	//echo $username;
$sql="SELECT * FROM  `Assigned_Leads` WHERE Disposition = 'fresh' AND UserName='".$username."' ORDER BY `Assigned_Leads`.`Id` DESC ";	
	
	//echo($sql);

	
	
	
$result = mysqli_query($connect,$sql);

echo('<table id="FollowUpLeadTable" class=" table table-bordered " cellspacing="0" width="100%">');
echo('<thead>');
 echo('<tr>');
  echo('<th>Date</th>');
  echo('<th>Full Name</th>');
  echo('<th>Email</th>');
  echo('<th>Mobile</th>');
  echo('<th>Disposition</th>');
  //echo('<th>Remark</th>');
  //echo('<th>Agent</th>');
  //echo('<th>Date</th>');
  echo('<th>State</th>');
 // echo('<th>Status</th>');
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
$mobile_sql = "SELECT Mobile from Assigned_Leads";

$mobile_sql_result = mysqli_query($connect,$mobile_sql);	
	
while($rm = mysqli_fetch_assoc($mobile_sql_result)){
                 $mobile[] = $rm['Mobile'];
            }

 $duplicate = array_count_values($mobile);

while($rows = mysqli_fetch_array($result))
  {
 
 $leads[] = $rows;
}
mysqli_close($connect);

foreach($leads as $row){

    echo('<tr class=""');
            // echo $duplicate[$row['Mobile']];
             
             
             
                    if($duplicate[$row['Mobile']]>1){
                        echo (' style=""');
                    
                    }
             echo ('>');
     
     
   echo('<td>'.$row['Date'].'</td>');
   echo('<td>'.$row['Full_Name'].'&nbsp;&nbsp;&nbsp;<a class = "upDateCommit" data-name = "'.$row['Full_Name'].'" data-id = "'.$row['Id'].'" href="javascript:void()"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>');
   echo('<td>'.$row['Email'].'</td>');
   echo('<td>'.'<a class="" href="'.'disposition.php?Mobile='.$row['Mobile'].'&Blaster&Disposition=Sale&UserName='.$username.'&FollowUpId='.$row['Id'].'&Full_Name='.$row['Full_Name'].'"><i class="fa fa-phone" aria-hidden="true"></i> '.$row['Mobile'].'</a>');
   if($duplicate[$row['Mobile']]>1){
    echo "<button class='btn btn-primary'>DUPLICATE</button>";   
   }
   
   echo ('
  
   <input type="text" value="'.$row['Mobile'].'" class="unique" style="color:#333;display:none;"/>
   </td>
    
   ');
   echo('<td>'.$row['Disposition'].'</td>');
   //echo('<td>'.$row['Remark'].'</td>');
   //echo('<td>'.$row['UserName'].'</td>');
   //echo('<td>'.$row['DateTime'].'</td>');
   echo('<td>'.$row['State'].'</td>');
  //echo('<td>'.'<form method="get" action="follow-up-done.php"><input type="hidden"  name="FollowUpId" value="'.$row['id'].'"/><input type="submit" value="Done" class="btn btn-primary"/></form>'.'</td>');
  echo "</tr>";
  }
  
  echo "</table>";







?>
</div>
</div>

</div>

<div id="UpdateSaleTarget" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Update Name</h4>

      </div>

      <form method="post" action="javascript:void(0)" id="Update_Commit_Form">

      <div class="modal-body">

          <p>Name : </p>
          <input type = "text" class = "form-control name_val" name = "full_name">

        <div> 

       

        <input id="updates_val_id" type="hidden" name="Id" value="0" class="form-control id_val"/>

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Update</button>

      </div>

      </form>

    </div>



  </div>

</div>
<script type="text/javascript">

	$(document).ready(function(){


var rowCount = $('#FollowUpLeadTable tr').length;

$('#totalRecord').text(rowCount - 1)
/*
	var seen = {};
$('#FollowUpLeadTable tr').each(function() {
    var txt = $(this).find(".unique").val();
    if (seen[txt])
        $(this).remove();
    else
        seen[txt] = true;
});
	*/
});

 $(".upDateCommit").click(function(){

            $("#UpdateSaleTarget").modal('show');

            var name= $(this).attr("data-name");
            
             var id= $(this).attr("data-id");

            $(".name_val").val(name);

              $(".id_val").val(id);
          

            

        })
        
         $("#Update_Commit_Form").submit(function(e){

            e.preventDefault;

            var formData = $("#Update_Commit_Form").serialize();

           $.ajax({

               type:"post",

               url:"Ajax_files/Update_Name.php",

               data:formData,

               success:function(datas){

                  // console.log(datas);

                  window.location.reload();

               }

               

           })

        })
	

	/*
 function highlightDuplicates() {
        // loop over all input fields in table
        $('#FollowUpLeadTable').find('input[type="text"]').each(function() {
            // check if there is another one with the same value
            if ($('#FollowUpLeadTable').find('input[value="' + $(this).val() + '"]').size() > 1) {
                // highlight this
                $(this).parent().parent('tr').addClass('duplicate');
				//$(this).parent().parent('tr').find('.btn-primary').trigger("click");
				//alert('duplicate found');
				window.location.href="follow-up-duplicate-delete.php"
            } else {
                // otherwise remove
                $(this).removeClass('duplicate');
            }
        });
    }


    $().ready(function() {
        // initial test
        highlightDuplicates();

        // fix for newer jQuery versions!
        // since you can select by value, but not by current val
        $('#FollowUpLeadTable').find('input').bind('input',function() {
            $(this).attr('value',this.value)
        });

        // bind test on any change event
        $('#FollowUpLeadTable').find('input').on('input',highlightDuplicates);
    });

  
	*/


</script>




<?php include('partial/footer.php') ?>

