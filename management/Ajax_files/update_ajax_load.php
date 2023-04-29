<?php include('../connection/dbconnection_crm.php')?>

<?php

$ids = $_GET['id'];

 $sel = "select * from Customer_Payment_History where id ='$ids' ";

$qry = mysqli_query($connect,$sel);

$fetch_data = mysqli_fetch_assoc($qry);

$PackageName = $fetch_data['PackageName'];

$PaymentMode = $fetch_data['PaymentMode'];

//print_r($fetch_data);



?>



 <div class="modal-body">

 <form action="customer-profile-payment-history-update-new.php" method="post" id="update_submit">

        <div class="alert alert-danger" style="display:none"> <strong>Please fill mandatory fields </strong> </div>

        <!-- -->

        <?php

        $sql = "SELECT MAX(Costumer_ID) as MaximumID FROM Customer_profile";

        $result = mysqli_query($connect,$sql);

        ?>

        <input type="hidden" id="cust" name="cust" value="<?php  echo $fetch_data['Costumer_ID']; ?>"/>

        

        <input type="hidden" id="DateTime" name="DateTime"   value="<?php echo date("Y-m-d h:i:s") ?>"/>

        <table width="100%"  border="0" class="table table-bordered" cellspacing="0" cellpadding="0">

          <!--  -->

          <tbody>

            <tr>

              <td>Sale Date*</td>

              <td>Packages</td>

              <td>Number_of_Days</td>

              <td>Total Received Amount*</td>

            </tr>

            <tr>

              <td><input type="hidden" value="<?php echo $ids; ?>" id="Costumer_ID" name="id" class="form-control" placeholder="Costumer ID" />

              

                <input type="text" value="<?php echo $fetch_data['SaleDate']; ?>" id="SaleDate" name="SaleDate"  class="form-control" placeholder="Sale Date"  autocomplete="off" required/>

                

                <!--<input type="hidden" value="2020-03-02" id="altSaleDate" name="altSaleDate" class="form-control" placeholder="alt Sale Date"/></td>-->

                

              <td>
                <div class="form-group">
                    <select class="form-control" name="Segment">
                        <option value="">Select Package</option>
                        <?php
                            $sel = "select Segment from Options where Segment != ''";
                            $qry = mysqli_query($connect,$sel);
                            while($r = mysqli_fetch_assoc($qry)){
                                if($PackageName == $r['Segment']){
                                    echo '<option selected value="'.$r['Segment'].'">'.$r['Segment'].'</option>';
                                    continue;
                                }
                                echo '<option value="'.$r['Segment'].'">'.$r['Segment'].'</option>';
                            }
                        ?>
                    </select>
                </div>
              </td>

              <td><input type="text" value="<?php echo $fetch_data['Number_of_Days']; ?>" id="" name="Number_of_Days" class="form-control" placeholder="Number of days" required/></td>

              <td><input type="text" value="<?php echo $fetch_data['Paid_Amout']; ?>" id="TotalReceivedAmount" name="TotalReceivedAmount" class="form-control" placeholder="Total Received Amount" required/></td>

            </tr>

            <tr>

              <td>Company Amount*</td>

              <td>Tax Amount*</td>

              <td>Payment Mode*</td>

              <td></td>

            </tr>

            <tr>

              <td><input type="text" value="<?php  echo $fetch_data['Company_Amount'];?>" id="Company_Amounts" name="Company_Amount" class="form-control" placeholder="Paid Amout" required/></td>

              <td><input type="text" value="<?php  echo $fetch_data['Tax_Amount'];?>" id="TAX_Amount" name="TAX_Amount" class="form-control" placeholder="TAX Amount" required/></td>

              <td colspan="2"><select class="form-control" id="PaymentMode" name="PaymentMode" required>

                  <?php include('../partial/payment_mode.php') ?>

                </select></td>

            

            </tr>

          

            <tr>

              

              <td>Agent One</td>

              <td>Agent Two</td>

              <td>Agent Three</td>

				<td></td>

            </tr>

            <tr>

             

              <td><select class="form-control" id="Agent_1" name="Agent_1" required>

                  <?php

                    $sql = ("SELECT `username` FROM `employee` WHERE `Status` = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select'  AND username !='Praveen Chhajlane' ORDER BY  `employee`.`username` ASC 

LIMIT 0 , 200");

                 echo('<option value="" selected>Select Agent</option>');

                $result = mysqli_query($connect,$sql);

                while($row = mysqli_fetch_array($result))

                {

                    if($row['username'] == $fetch_data['Agent_1']){

                         echo('<option value="'.$row['username'].'" selected>'.$row['username'].'</option>');

                         continue;

                    }

                  echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');

                }





                  

                  ?>

                </select></td>

              <td><select class="form-control" id="Agent_2" name="Agent_2" >

                  <?php

                    $sql = ("SELECT `username` FROM `employee` WHERE `Status` = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select'  AND username !='Praveen Chhajlane' ORDER BY  `employee`.`username` ASC 

LIMIT 0 , 200");

                 echo('<option value="" selected>Select Agent</option>');

                $result = mysqli_query($connect,$sql);

                while($row = mysqli_fetch_array($result))

                {

                    if($row['username'] == $fetch_data['Agent_2']){

                         echo('<option value="'.$row['username'].'" selected>'.$row['username'].'</option>');

                         continue;

                    }

                  echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');

                }





                  

                  ?>

                </select></td>

              <td><select class="form-control" id="Agent_3" name="Agent_3" >

                  <?php

                    $sql = ("SELECT `username` FROM `employee` WHERE `Status` = 'Active' AND username !='Akshay Shetty' AND username !='Sudheer Singh' AND username !='Select'  AND username !='Praveen Chhajlane' ORDER BY  `employee`.`username` ASC 

LIMIT 0 , 200");

                 echo('<option value="" selected>Select Agent</option>');

                $result = mysqli_query($connect,$sql);

                while($row = mysqli_fetch_array($result))

                {

                    if($row['username'] == $fetch_data['Agent_3']){

                         echo('<option value="'.$row['username'].'" selected>'.$row['username'].'</option>');

                         continue;

                    }

                  echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');

                }





                  

                  ?>

                </select></td>

				 <td></td>

            </tr>

            <tr>

             

              <td><input type="text" placeholder="%" value="<?php echo $fetch_data['Agent_1_Percentange']; ?>" id="Agent_1_Percentange" name="Agent_1_Percentange" class="form-control" style="width: 70px;float: left;" required>

                <input type="text" name="Agent_1_Shared_Amount" id="Agent_1_Shared_Amount" value="<?php echo $fetch_data['Agent_1_Shared_Amount']; ?>" placeholder="Shared Amount" class="form-control" style="width: 110px;float: left;" required readonly></td>

              <td><input type="text" placeholder="%" value="<?php echo $fetch_data['Agent_2_Percentange']; ?>" id="Agent_2_Percentange" name="Agent_2_Percentange" class="form-control" style="width: 70px;float: left;" >

                <input type="text" value="<?php echo $fetch_data['Agent_2_Shared_Amount']; ?>" placeholder="Shared Amount" id="Agent_2_Shared_Amount" name="Agent_2_Shared_Amount" class="form-control" style="width: 110px;float: left;" readonly></td>

              <td><input type="text" placeholder="%" value="<?php echo $fetch_data['Agent_3_Percentange']; ?>" id="Agent_3_Percentange" name="Agent_3_Percentange" class="form-control" style="width: 70px;float: left;" >

                <input type="text" value="<?php echo $fetch_data['Agent_3_Shared_Amount']; ?>" name="Agent_3_Shared_Amount" id="Agent_3_Shared_Amount" placeholder="Shared Amount" class="form-control" style="width: 110px;float: left;" readonly></td>

				 <td></td>

            </tr>

          </tbody>

        </table>

        <!-- -->

         <button type="submit" class="btn btn-primary" id="">Update</button>

          </form>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

         

        </div>

     

      

      <script>



$( "[name='SaleDate']" ).datepicker({

	dateFormat: 'dd-mm-yy', 

    altField  : '#altSaleDate',

    altFormat : 'yy-mm-dd',

    format    : 'yy-mm-dd'

});



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



      </script>