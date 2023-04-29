
<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once($_SERVER['DOCUMENT_ROOT']."/crm/agent/connection/dbconnection_crm.php");


   
   $USDoB = date('m-d');
    //Birthday Notfication
    
   $sel = "select * from employee where Status = 'Active' and Date_of_Birth like '%".$USDoB."%'";
    $qry = mysqli_query($connect,$sel);
 

    $fetch = array();
    while($row = mysqli_fetch_assoc($qry)){
        $fetch[] = $row;
    }

    if(count($fetch)>0){
    
        foreach($fetch as $dobd){
            if($_COOKIE[str_replace(' ', '', $dobd['username'])] != ''){
                continue;
            }
            ?>
            <div class="alert alert-info fade in alert-dismissible text-center"> 
                <div style="width: 500px; margin:0 auto;" class="font-size30"> 
                        <span style="font-size: 17px !important;"> <img src="images/Cake.png"  style="width:100px;"/> Birthday Of <strong><?php echo $dobd['username']; ?></strong></span> 
			                <a href="#" id="" data-agent_id="<?php echo str_replace(' ', '', $dobd['username']); ?>" class="btn btn-danger update_birthday_notificationstatus" data-dismiss="alert" aria-label="close" title="close">Close
			                </a>
			    </div>
            </div>
            
            <?php
        }
    }





?>
<script>
    $(document).ready(()=>{
        $(".update_birthday_notificationstatus").click((e)=>{
            var data_id = e.target.dataset.agent_id;
            document.cookie = data_id+"=shown; expires="+(parseInt(new Date().getTime()) + parseInt(86400000))+"; path=/";
            //console.log(data_id);
        })
    })
</script>