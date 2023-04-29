<?php
 include('../connection/dbconnection_crm.php');
 
if($_POST){
    $id = $_POST['emp_id'];
  $img_r = imagecreatefromjpeg($_POST['imgs']);
  $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
 
  imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'],$_POST['h']);
  
  header('Content-type: image/jpeg');
  imagejpeg($dst_r,"tmp/img.jpg");
    
    $path = 'tmp/img.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    
        $pd_qry = "UPDATE employee SET Photo = '$base64' WHERE Id = '$id'";
        mysqli_query($connect, $pd_qry);
    
    $json_data['status'] = 'success';
    $json_data['image_base'] = $base64;
    unlink("tmp/img.jpg");
    print json_encode($json_data);
  exit;

  
//  print_r($_POST);
}

?>