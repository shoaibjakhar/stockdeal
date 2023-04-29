

<div class="row">
  <div class="col-sm-12" style="display:;">
    <div class="panel panel-default" style="">
      <div class="panel-heading font-size16"><a href="news-and-updates.php">News and Updates</a> 
		  <?php if ( $_SESSION['Role'] == 'Admin' or $_SESSION['Role'] == 'Super Admin' ) {
	echo ('<a href="#" class="btn  btn-primary pull-right" style="margin-top: -6px;"  data-toggle="modal" data-target="#AddNewPost"> <i class="fa fa-plus" aria-hidden="true"></i> New Post</a>');
}  ?>
		  </div>
      <div class="panel-body PT30 ">
        <?php
						
$sql = "SELECT * FROM `News_and_Updates` WHERE Status = 'Active' ORDER BY Id DESC";
if($result = mysqli_query($connect, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table id="Agent_profile" class="table table-bordered table-hover MT20" cellspacing="0" width="100%">';
            echo('<thead>');
 echo('<tr style="display:none;">');
  echo('<th></th>');

  if ( $_SESSION['Role'] == 'Admin' or $_SESSION['Role'] == 'Super Admin' ) {
	echo ('<th></th>');
} 
  
 
 echo('</tr>');
echo('</thead>');
echo('<tbody>');
        while($row = mysqli_fetch_array($result)){
            echo('<tr>');
   echo('<td>
   <h3><a href="news-and-updates-single-post.php?post_id='.$row['Id'].'">'.$row['Subject'].'</a></h3>
   <div class="MB20"><span class="bold MR20">Date: '.$row['DateTime'].'</span><span class="bold MR20">Author: '.$row['Author_Name'].'</span></div>
   
   </td>');

if ( $_SESSION['Role'] == 'Admin' or $_SESSION['Role'] == 'Super Admin' ) {
	echo '<td style="vertical-align: middle;"><a href="News-and-Updates/delete-post.php?post_id='.$row['Id'].'" class="btn btn-danger btn-sm">Delete</a></td>';
} 
   
   
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} 
 
// Close connection
//mysqli_close($connect);
?>	
      </div>
    </div>
  </div>
</div>


<?php include('add-post-popup.php'); ?>
