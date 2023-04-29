
 <?php
	 $result = mysqli_query($connect,"SELECT Sidebar_Menu_File FROM Options WHERE Id = '1'");
         $Sidebar_Menu_File = mysqli_result($result, 0);
			//echo($Sidebar_Menu_File);
			
	    ?>


<?php include($Sidebar_Menu_File); ?>

