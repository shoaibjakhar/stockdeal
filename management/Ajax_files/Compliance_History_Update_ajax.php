<?php include('../connection/dbconnection_crm.php')?>

<?php

$ids = $_GET['id'];

 $sel = "select * from Compliance_History where id ='$ids' ";

$qry = mysqli_query($connect,$sel);

$fetch_data = mysqli_fetch_assoc($qry);

$PackageName = $fetch_data['PackageName'];

$PaymentMode = $fetch_data['PaymentMode'];

//print_r($fetch_data);



?>



 <div class="modal-body">

 <form action="Compliance_History_Update.php" method="post" id="update_submit">

        <div class="alert alert-danger" style="display:none"> <strong>Please fill mandatory fields </strong> </div>

        <!-- -->

        <?php

        $sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";

        $result = mysqli_query($sql);

        ?>

        <input type="hidden" id="cust" name="cust" value="<?php  echo $fetch_data['Costumer_ID']; ?>"/>

        

        <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>

        <table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">

          <!--  -->

          <tbody>

            <tr>

              <td> Date*</td>

             <td colspan="3">Compliance_Remarks</td>

          

              

            </tr>

            <tr>

              <td><input type="hidden" value="<?php echo $ids; ?>" id="Costumer_ID" name="id" class="form-control" placeholder="Costumer ID" />

              

                <input type="date" value="<?php echo $fetch_data['SaleDate']; ?>" id="" name="SaleDate"  class="form-control" placeholder=""  autocomplete="off" required/>
 </td>
                

              

                

              

             

              <td>
				
				
				<textarea name="Compliance_Remarks" id="Compliance_Remarks" cols="30" rows="10" class="form-control"><?php echo $fetch_data['Compliance_Remarks']; ?></textarea>
				</td>

            </tr>

          


          </tbody>

        </table>

        <!-- -->

         <button type="submit" class="btn btn-primary" id="">Update</button>

          </form>

        </div>

       

     

      

      <script>



$( "[name='SaleDate']" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#altSaleDate',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});


/*
$("#update_submit").submit((e)=>{

   // e.preventDefault();

  var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;

  var per2 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;

  var per3 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;

  var total = parseInt(per1)+parseInt(per2)+parseInt(per3);

  console.log(total);

  if(per1>100 || per2>100 || per3>100){

      alert('Percentage must be less then equals to 100');

      return false;

  }

  else if((total <99 && total<100) || total>100){

      alert('Total percentage must be 100%');

      return false;

  }

   

    

})

$("#Agent_1_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_1_Percentange").val())?parseInt($("#Agent_1_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_1_Shared_Amount").val(per);

    

    

})

$("#Agent_2_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_2_Percentange").val())?parseInt($("#Agent_2_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_2_Shared_Amount").val(per);

    

    

})

$("#Agent_3_Percentange").keyup(()=>{

    var company_am =  parseInt($("#Company_Amounts").val());

    var per1 = parseInt($("#Agent_3_Percentange").val())?parseInt($("#Agent_3_Percentange").val()):0;

    var per =  company_am*(per1/100);

   $("#Agent_3_Shared_Amount").val(per);

    

    

})

*/

      </script>