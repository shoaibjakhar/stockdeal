<?php

$sql = ("SELECT `username` FROM `employee` WHERE `Status` = 'Active' ORDER BY  `employee`.`username` ASC LIMIT 0 , 200");
echo("$('.AgentNames').html('"); 
$result = mysqli_query($connect, $sql);
echo('<option value="">Select</option>');
while($row = mysqli_fetch_array($result))

{
  echo('<option value="'.$row['username'].'">'.$row['username'].'</option>');
}
echo("')");

?>