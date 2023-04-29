<?php
if($_FILES){
    $upload_to  = "tmp/".$_FILES['input_file_name']['name'];
    move_uploaded_file($_FILES['input_file_name']['tmp_name'],$upload_to);
    $json_data['img_name'] = $upload_to;
    $json_data['status'] = 'success';
    print json_encode($json_data);
}
?>