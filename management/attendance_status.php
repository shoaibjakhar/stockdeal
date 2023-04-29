   <?php 

    include('connection/dbconnection_crm.php');

   $query="SELECT * FROM `attendence`";
     $qry_att = mysqli_query($connect, $query);
         
         while($row = mysqli_fetch_assoc($qry_att))
         {
            $ex_date_time = explode(" ",$row['login_time']);
            $new_date = date('m/d/Y',strtotime($ex_date_time[0]))." 09:15:00 AM";
       

            $on_time=strtotime($new_date);
            $login_time_1=strtotime($row['login_time']);
            // echo  $login_time_1;
            // echo  " = ".$on_time;
            if($login_time_1>$on_time)
              {
                // echo " Late<br>";
                $query = "update attendence set on_time_status =1 where id ='".$row['id']."'";
                mysqli_query($connect, $query);
              }
              else
              {
                // echo " ontime<br>";
               $query = "update attendence set on_time_status =2 where id ='".$row['id']."'";
               mysqli_query($connect, $query);
              }
            // echo $new_date." = ";
            // echo $row['login_time']."<br>";
         }
        echo "Attendence updated successfuly";
?>