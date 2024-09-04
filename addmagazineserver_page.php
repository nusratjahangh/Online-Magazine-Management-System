<?php
//addserver_page.php
include("data_class.php");



$magazinename=$_POST['magazinename'];
$magazinedetail=$_POST['magazinedetail'];
$magazineaudor=$_POST['magazineaudor'];
$magazinepub=$_POST['magazinepub'];
$branch=$_POST['branch'];
$magazineprice=$_POST['magazineprice'];
$magazinequantity=$_POST['magazinequantity'];



if (move_uploaded_file($_FILES["magazinephoto"]["tmp_name"],"myprojectpics/" . $_FILES["magazinephoto"]["name"])) {

    $magazinepic=$_FILES["magazinephoto"]["name"];

$obj=new data();
$obj->setconnection();
$obj->addmagazine($magazinepic,$magazinename,$magazinedetail,$magazineaudor,$magazinepub,$branch,$magazineprice,$magazinequantity);
  } 
  else {
     echo "File not uploaded";
  }