<?php

include("data_class.php");

$magazine=$_POST['magazine'];
$userselect= $_POST['userselect'];
$getdate= date("d/m/Y");
$days= $_POST['days'];

$returnDate=Date('d/m/Y', strtotime('+'.$days.'days'));

$obj=new data();
$obj->setconnection();
$obj->purchasemagazine($magazine,$userselect,$days,$getdate,$returnDate);
