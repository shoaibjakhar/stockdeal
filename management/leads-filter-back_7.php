<?php include('connection/dbconnection_crm.php')?>


<?php

$StartDateUSA = $_GET['StartDateUSA'];
$EndtDateUSA = $_GET['EndtDateUSA'];
$disposition = $_GET['disposition'];
$source_name = $_GET['source_name'];
$username = $_GET['username'];
$limit = $_GET['limit'];
/*
echo($StartDateUSA );
echo($EndtDateUSA);
echo($disposition);
echo($source_name);
echo($username);
echo($limit);
*/


//$sql = ("SELECT  Ideas, Sagment, DATE_FORMAT( DateTime,  '%d-%m-%Y %h : %i %p' ) AS DateTimeCurrent FROM stock_tips ORDER BY  `DateTime` DESC LIMIT 0 , 30");

//$sql = ("SELECT * FROM stock_tips WHERE Date >= '".$StartDate."' AND Date <= '".$EndtDate ."' && `Sagment` ='".$Packages."' limit 30");

/*
$sql = ("SELECT Id, Full_Name, Email, Mobile, State, Source, UserName, Date, DATE_FORMAT( DateTime,  '%d-%m-%Y %h %i %p' ) AS DateTimeCurrent FROM Assigned_Leads WHERE DATE(DateTime) >= '".$StartDateUSA."' AND DATE(DateTime) <= '".$EndtDateUSA."' && `username` ='".$username."' && `Disposition` ='".$disposition."' && `Source` ='".$source_name."' ORDER BY  `Assigned_Leads`.`Id` DESC  LIMIT 0, $limit" );
*/

$sql = ("SELECT Id, Full_Name, Email, Mobile, Disposition, State, Source, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE (`TimeStamp` > DATE_SUB(now(), INTERVAL 7 DAY)) && `username` ='".$username."' && `Disposition` ='".$disposition."' && `Source` ='".$source_name."' ORDER BY  `Assigned_Leads`.`TimeStamp` DESC  LIMIT 0, $limit");


/*
$sql = ("SELECT Id, Full_Name, Email, Mobile, Disposition, State, Source, UserName, Date, DateTime, TimeStamp, ModalFowllowUpDateTime FROM Assigned_Leads WHERE  `TimeStamp` < NOW( ) - INTERVAL 1 WEEK AND `ModalFowllowUpDateTime` < NOW( ) - INTERVAL 1 WEEK && `username` ='".$username."' && `Disposition` ='".$disposition."' && `Source` ='".$source_name."' ORDER BY  `Assigned_Leads`.`TimeStamp` DESC  LIMIT 0, $limit" );
*/

$result = mysqli_query($connect, $sql) or die($sql."<br/><br/>".mysql_error());

$i = 0;
echo "<form name='form_update' method='post' action='leads-update_7.php'>\n";
echo '<table id="" style="margin-top:10px;" class="table table-bordered rowcount">';
echo '<tr class="brand-color-bg">';
echo '<td style="display:none">Id</td>';
echo '<td>Full_Name</td>';
echo '<td>Email</td>';
echo '<td>Mobile</td>';
echo '<td>State</td>';
echo '<td>Source</td>';
echo '<td>Disposition</td>';
echo '<td>UserName</td>';
echo '<td>Last updated</td>';
echo '<td>Follow up date</td>';
echo '</tr>';

while ($students = mysqli_fetch_array($result)) {
	echo '<tr>';
	echo "<td style='display:none'>{$students['Id']}<input type='hidden' name='Id[$i]' value='{$students['Id']}' /></td>";
	echo "<td>{$students['Full_Name']}</td>";
	echo "<td>{$students['Email']}</td>";
	echo "<td>{$students['Mobile']}</td>";
	echo "<td>{$students['State']}</td>";
	echo "<td>{$students['Source']}</td>";
	echo "<td>{$students['Disposition']}</td>";
	echo "<td class='UserNameData'>{$students['UserName']}</td>";
	echo "<td style='display:none'><input style='width:150px;border: none;' class='AgentNames' type='text' size='40' name='UserName[$i]' value='{$students['UserName']}' /></td>";
	echo "<td>{$students['TimeStamp']}</td>";
	echo "<td>{$students['ModalFowllowUpDateTime']}</td>";
	echo '</tr>';
	++$i;
}
echo '<tr>';
?>

<?php echo'<td>'?>
<?php echo'<select class="form-control" id="Agent">'?>
          <?php include('partial/agents.php') ?>
         <?php echo'</select>'?>
<?php echo'</td>'?>
 
<?php
echo "<td><input class='btn btn-primary' type='submit'value='Update' /></td>";
echo '</tr>';
echo "</form>";
echo '</table>';
//header('Location: leads-filter_3_new.php')
?>

<sc


