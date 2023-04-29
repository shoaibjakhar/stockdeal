<?php 
    include('partial/session_start.php');

//include($_SERVER['DOCUMENT_ROOT']."/partial/access-control-role-base.php"); 


//error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
<title>Website Leads</title>
<?php require('partial/plugins.php'); ?>
<!-- <link rel="stylesheet" href="style.css"/>
<script type="text/javascript" src="js/jquery.min.js"></script> -->
<script type="text/javascript">
/*
    function delete_confirm(){
    var result = confirm("Are you sure to delete users?");
    if(result){
        return true;
    }else{
        return false;
    }
}
*/
$(document).ready(function(){
   
    
    if ($('#person_data[document_type]').val() != ''){
        
    }
    
$("#AgentNames").change(function(){
  
    var agentName = $(this).val();
    
    if (( $(this).val() == '0' || $(this).val() == '' || $(this).val() == 'undefined' || $(this).val() == null )){
        $('.bulk_delete_submit').hide();
    }
    
    else {
        $('.bulk_delete_submit').show();
    }
    
});
    
    
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
    
    setTimeout(function(){ 
    $('.alert-success').hide();
    }, 1000);
    
});
</script>
    <style>

.duplicate {
    background:#ec7b7b;
        color:#333;
}

    .Administrator {
           color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    }
input[type="checkbox"]{
  width: 16px; /*Desired width*/
  height: 16px; /*Desired height*/
    cursor: pointer;
}
    
.table tr:hover{
    background:#fcf8e3;    
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
 <a href="memberpage.php">Dashbord</a> | <a href="website-leads-rsi.php">Single Assign</a> | <a href="assign-multiple-leads.php" class="btn btn-xs btn-primary">Multiple Assign</a> | <a href="leads-filter_4_new.php">Re Assign</a> | <a href="#">Analytics</a>
</div> 

  <div class="containter" style="padding:20px 20px 0 20px;">
<?php session_start(); if(!empty($_SESSION['success_msg'])){ ?>
<div class="alert alert-success"><?php echo $_SESSION['success_msg']; ?></div>
<?php unset($_SESSION['success_msg']); } ?>
<?php
include_once('connection/dbConfig.php');
 $sel = "select * from employee where Team_Leader = '".$username."' and Status='Active' order by username ASC ";
    $qry = mysqli_query($connect, $sel);
    $teams = array();
    while($fetch = mysqli_fetch_assoc($qry)){
        $teams[] = $fetch['username'];
    }
     //print_r($teams); 
     
$mobile_sql = "SELECT Mobile from Assigned_Leads";

$mobile_sql_result = mysqli_query($connect, $mobile_sql);

if($_SESSION['Role'] == 'Team Leader'){

    $sel_data = ("SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition,SubSource,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE UserName = '".$username."' AND Disposition = 'Fresh' ORDER BY  `id` DESC");
}
else if($_SESSION['Role'] == 'SR_TL'){

    $sel_data = ("SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition,SubSource,  UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE UserName = '".$username."' AND Disposition = 'Fresh' ORDER BY  `id` DESC");
}
else{
    $sel_data = ("SELECT Id, Full_Name, Email, Mobile, State, Source, Disposition, SubSource, UserName, Message, remoteAddress, Status, Investment, Segment,  DATE_FORMAT(LeadDateTime,  '%d/%m/%Y %h:%i') AS DateTimeINR FROM  `Assigned_Leads` WHERE (Status IS NULL OR Status='Open') AND Disposition = 'Fresh' ORDER BY  `id` DESC");

    
}

//echo $sel_data;
//$query = mysqli_query($conn,$sel_data);
$query = mysqli_query($connect, $sel_data);

?>
<form name="bulk_action_form" action="assign-multiple-leads-back.php" method="post" onSubmit="return delete_confirm();"/>
    <table style="width:280px; margin-bottom:10px;" border="0" class="">
  <tr>
   <!-- <td style="width: 100px; border-top:none;"> <input type="checkbox" name="select_all " id="select_all" value=""/> Select All</td> -->
   <td style="width:40px;"> <span style="font-size:20px;" class="CountSelected">0</span>&nbsp;&nbsp;&nbsp;</td>
    <td style="border-top:none;padding: 0;"><select class="form-control" name="AgentNames" id="AgentNames" style="width: 280px;"><?php 
    
   // include('partial/agents.php');
    if($_SESSION['Role'] == 'Super Admin'){
        echo '<option value="">Select SR Team Leader</option>';
           // include('partial/agents.php');
           $sel_tls = "SELECT * FROM `employee` WHERE Role = 'SR_TL' AND Status = 'Active'";
           $qry_tls = mysqli_query($connect, $sel_tls);
           while($row_tls = mysqli_fetch_assoc($qry_tls)){
               echo '<option value="'.$row_tls['username'].'">'.$row_tls['username'].'</option>';
           }
        }
        else if($_SESSION['Role'] == 'SR_TL'){
        echo '<option value="">Select Team Leader</option>';
           // include('partial/agents.php');
           $sel_tls = "SELECT * FROM `employee` WHERE Role = 'Team Leader' AND Team_Leader ='".$username."' AND Status = 'Active'";
           $qry_tls = mysqli_query($connect, $sel_tls);
           while($row_tls = mysqli_fetch_assoc($qry_tls)){
               echo '<option value="'.$row_tls['username'].'">'.$row_tls['username'].'</option>';
           }
        }
        else{
            
           // echo("$('.AgentNames').html('"); 
            echo('<option value="">Select</option>');
            foreach($teams as $team){
                echo '<option value="'.$team.'">'.$team.'</option>';
            }
           // echo("')");
        }
    ?></select></td>
    <td style="border-top:none;padding: 0;"><input type="submit" style="display: none" class="btn btn-primary bulk_delete_submit" name="bulk_delete_submit" value="SUBMIT"/></td>  
  </tr>
</table>

  
    <table id="assign_multiple_leads" class="table table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th></th>        
            <th style="width: 160px;">Full Name</th>
            <th style="width:60px;">Date</th>
            <th>Mobile</th>
            <th>Status</th>
             <th style="width: 160px;">
            <?php
              if($_SESSION['Role'] == 'SR_TL'){
                echo 'SR Team Lead';
               }
               if($_SESSION['Role'] == 'Team Leader'){
                  echo 'Team Lead';
               }
              if($_SESSION['Role'] == 'Super Admin'){
                 echo 'SR Team Lead';
              }?>
             </th>
            <th>Investment</th>
            <th>Segment</th>
            <th>State</th>
            <th>Source</th>
            <th>SubSource</th>
            <th>Disposition</th>
           
        
            
            
        </tr>
        </thead>
        <?php
   
        // print"<pre>";
        // print_r($teams);
        while($rm = mysqli_fetch_assoc($mobile_sql_result)){
                 $mobile[] = $rm['Mobile'];
            }
           
            if(mysqli_num_rows($query) > 0){
                $i = 0;
                while($rows = mysqli_fetch_assoc($query)){
                    
                     //print_r($rows['Mobile']);
                   // $mobile[] = $rows['Mobile'];
                    //var_dump($rows);
                   
                    if($_SESSION['Role'] == 'Super Admin'){
                           $i++;
                           $leads[] = $rows; 
                           if($i == 5000){
                                break;
                            }
                       }
                       else{
                          // echo $rows['UserName'].'\n ';
                        //   if(!in_array($rows['UserName'],$teams)){
                        //       $tn[] = $rows['UserName'];
                        //       continue;
                               
                        //   }
                        //   else{
                        //       $i++;
                        //       $leads[] = $rows; 
                        //   }
                         $i++;
                        $leads[] = $rows; 
                           
                            if($i == 5000){
                                break;
                            } 
                       }
                       
                      // print_r($leads);
        ?>
        
        <?php } 
        
        
         $duplicate = array_count_values($mobile);
         
        }else{ ?>
            <tr><td colspan="5">No records found.</td></tr> 
        <?php }
       
        if(!empty($leads)){
                foreach($leads as $row){
                    ?>
                     <?php echo('<tr class="'.$row['UserName'].'"');
                     
                            if($duplicate[$row['Mobile']]>1){
                                echo (' style=""');
                            
                            }
                     echo ('>'); ?>
                     
                     
                    <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['Id']; ?>"/></td>        
                    <td><?php echo $row['Full_Name']; ?></td>
                    <td><?php echo $row['DateTimeINR']; ?></td>
                    <?php  
                    
                    echo('<td class="">').$row['Mobile'];
         
         if($duplicate[$row['Mobile']]>1){
            echo (' <button class="btn btn-primary btn-sm" type="button">DUPLICATE</button>');
        
        }
         echo ('</td>'); 
         
         
         ?>
                    <td><?php echo('<a href="#_" class="btn btn-danger">'.$row['Status'].'</a>'); ?></td></td>
                    <td><?php echo $row['UserName']; ?></td>
               <td><?php echo $row['Investment']; ?></td>
                    <td><?php echo $row['Segment']; ?></td>
                    <td><?php echo $row['State']; ?></td>
                    <td><?php echo $row['Source']; ?></td>
                    <td><?php echo $row['SubSource']; ?></td>
                    <td><?php echo $row['Disposition']; ?></td>
                   
                    
                </tr> 
                    
                    <?php
                }
        }
        

        
        ?>
   
    </table>
   
</form>
    </div>
<?php include('partial/footer.php') ?>

<script>
    $(document).ready(()=>{
        $(".checkbox").click(()=>{
            var arr = [];
            $("input.checkbox:checkbox:checked").each((e)=>{
                arr.push(e);
            });
            $(".CountSelected").text(arr.length);
        })
        
    })
</script>
<script>
     $('#assign_multiple_leads').DataTable();
</script>
</body>

</html> 