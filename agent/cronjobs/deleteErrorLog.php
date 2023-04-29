<?php

if($handle = opendir('../')){
    while(false !== ($entry = readdir($handle))){
        if($entry != '.' && $entry != '..'){
           if($entry == 'error_log'){
                unlink("../".$entry);
           }
        }
    }
    closedir($handle);
}


?>