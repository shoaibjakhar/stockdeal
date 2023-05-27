<?php

function pre($data){
  echo "<pre>"; print_r($data); echo "</pre>";
}

function pre_d($data){
  echo "<pre>"; print_r($data); echo "</pre>"; die();
}

?>