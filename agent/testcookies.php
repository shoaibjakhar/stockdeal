<?php

//backup_tables('localhost','shareevx_root','Ahmed@123456','shareevx_rsicrm');

//
backup_tables('localhost','shareevx_root','Ahmed@123456','shareevx_rsicrm','admin','admin');





//Start Download whole database in once


function backup_tables($host,$user,$pass,$name,$tables = '*',$filename=null)
{

  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($name,$link);
  $return="";

//echo $tables;

  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysqli_query($connect,'SHOW TABLES');

    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];

    }
   // print_r($tables);
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  //cycle through
  foreach($tables as $table)
  {
    $result = mysqli_query($connect,'SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    //print_r($num_fields);exit;
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysql_fetch_row(mysqli_query($connect,'SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";

    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
         // $row[$j] = preg_replace("\n","\\n",$row[$j]);

          $row[$j] = preg_replace("/(\n){2,}/", "\\n", $row[$j]); 

          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";

  }


//End Whole database




if($filename == '' || $filename == null){
     $filename = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
}
else{
   $filename = $filename.".sql"; 
}

  //save file
 
  
  $handle = fopen($filename,'w+');
 // print_r($handle);exit;
  fwrite($handle,$return);
  fclose($handle);
  
  
  $file = $filename;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    unlink($file);
    exit;
}



}













?>