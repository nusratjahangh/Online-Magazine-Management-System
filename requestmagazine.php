<?php

include("data_class.php");

$userid=$_GET['userid'];
$magazineid=$_GET['magazineid'];





$obj=new data();
$obj->setconnection();
$obj->requestmagazine($userid,$magazineid);

?>