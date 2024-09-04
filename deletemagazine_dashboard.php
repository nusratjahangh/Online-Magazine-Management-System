<?php
include("data_class.php");

$deletemagazineid=$_GET['deletemagazineid'];


$obj=new data();
$obj->setconnection();
$obj->deletemagazine($deletemagazineid);