<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
issue
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
        .innerright,label {
    color: rgb(16, 170, 16);
    font-weight:bold;
}
.container,
.row,
.imglogo {
    margin:auto;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}
input{
    margin-left:20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: rgb(105, 221, 105);
}

.greenbtn {
    background-color: rgb(16, 170, 16);
    color: white;
    width: 95%;
    height: 40px;
    margin-top: 8px;
}

.greenbtn,
a {
    text-decoration: none;
    color: white;
    font-size: large;
}

th{
    background-color: orange;
    color: black;
}
td{
    background-color: #fed8b1;
    color: black;
}
td, a{
    color:black;
}
    </style>
    <body>

    <?php
   include("data_class.php");

$msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.png"/></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn"> ADMIN</Button>
                <Button class="greenbtn" onclick="openpart('addmagazine')" >ADD MAGAZINE</Button>
                <Button class="greenbtn" onclick="openpart('magazinereport')" > MAGAZINE REPORT</Button>
                <Button class="greenbtn" onclick="openpart('magazinerequestapprove')"> MAGAZINE REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD AUTHOR</Button>
                <Button class="greenbtn" onclick="openpart('authorrecord')"> AUTHOR REPORT</Button>
                <Button class="greenbtn"  onclick="openpart('purchasemagazine')"> PURCHASE MAGAZINE</Button>
                <Button class="greenbtn" onclick="openpart('purchasemagazinereport')"> PURCHASE REPORT</Button>
                <a href="index.php"><Button class="greenbtn" > LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">   
            <div id="magazinerequestapprove" class="innerright portion" style="display:none">
            <Button class="greenbtn" >MAGAZINE REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestmagazinedata();
            $recordset=$u->requestmagazinedata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Magazine name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                 $table.="<td><a href='approvemagazinerequest.php?reqid=$row[0]&magazine=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="addmagazine" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="greenbtn" >ADD NEW MAGAZINE</Button>
            <form action="addmagazineserver_page.php" method="post" enctype="multipart/form-data">
            <label>Magazine Name:</label><input type="text" name="magazinename"/>
            </br>
            <label>Detail:</label><input  type="text" name="magazinedetail"/></br>
            <label>Autor:</label><input type="text" name="magazineaudor"/></br>
            <label>Publication</label><input type="text" name="magazinepub"/></br>
            <div>Branch:<input type="radio" name="branch" value="other"/>other<input type="radio" name="branch" value="BSIT"/>BSIT<div style="margin-left:80px"><input type="radio" name="branch" value="BSCS"/>BSCS<input type="radio" name="branch" value="BSSE"/>BSSE</div>
            </div>   
            <label>Price:</label><input  type="number" name="magazineprice"/></br>
            <label>Quantity:</label><input type="number" name="magazinequantity"/></br>
            <label>Magazine Photo</label><input  type="file" name="magazinephoto"/></br>
            </br>
   
            <input type="submit" value="SUBMIT"/>
            </br>
            </br>

            </form>
            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <Button class="greenbtn" >ADD Person</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="addname"/>
            </br>
            <label>Pasword:</label><input type="pasword" name="addpass"/>
            </br>
            <label>Email:</label><input  type="email" name="addemail"/></br>
            <label for="typw">Choose type:</label>
            <select name="type" >
                <option value="author">author</option>
                <option value="teacher">teacher</option>
            </select>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="authorrecord" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Author RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="purchasemagazinereport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Purchase Magazine Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->purchasereport();
            $recordset=$u->purchasereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Purchase Name</th><th>Magazine Name</th><th>Purchase Date</th><th>Return Date</th><th>Fine</th></th><th>Purchase Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

<!--             

issue book -->
            <div class="rightinnerdiv">   
            <div id="purchasemagazine" class="innerright portion" style="display:none">
            <Button class="greenbtn" >PURCHASE MAGAZINE</Button>
            <form action="purchasemagazine_server.php" method="post" enctype="multipart/form-data">
            <label for="magazine">Choose Magazine:</label>
            <select name="magazine" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getmagazinepurchase();
            $recordset=$u->getmagazinepurchase();
            foreach($recordset as $row){

                echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
        
            }            
            ?>
            </select>

            <label for="Select Author">:</label>
            <select name="userselect" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();
            foreach($recordset as $row){
               $id= $row[0];
                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
            }            
            ?>
            </select>
<br>
            Days<input type="number" name="days"/>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="magazinedetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <Button class="greenbtn" >MAGAZINE DETAIL</Button>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getmagazinedetail($viewid);
            $recordset=$u->getmagazinedetail($viewid);
            foreach($recordset as $row){

                $magazineid= $row[0];
               $magazineimg= $row[1];
               $magazinename= $row[2];
               $magazinedetail= $row[3];
               $magazineauthour= $row[4];
               $magazinepub= $row[5];
               $branch= $row[6];
               $magazineprice= $row[7];
               $magazinequantity= $row[8];
               $magazineava= $row[9];
               $magazinerent= $row[10];

            }            
?>

            <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
            </br>
            <p style="color:black"><u>Magazine Name:</u> &nbsp&nbsp<?php echo $magazinename ?></p>
            <p style="color:black"><u>Magazine Detail:</u> &nbsp&nbsp<?php echo $magazinedetail ?></p>
            <p style="color:black"><u>Magazine Author:</u> &nbsp&nbsp<?php echo $magazineauthor ?></p>
            <p style="color:black"><u>Magazine Publisher:</u> &nbsp&nbsp<?php echo $magazinepub ?></p>
            <p style="color:black"><u>Magazine Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
            <p style="color:black"><u>Magazine Price:</u> &nbsp&nbsp<?php echo $magazineprice ?></p>
            <p style="color:black"><u>Magazine Available:</u> &nbsp&nbsp<?php echo $magazineava ?></p>
            <p style="color:black"><u>Magazine Rent:</u> &nbsp&nbsp<?php echo $magazinerent ?></p>


            </div>
            </div>



            <div class="rightinnerdiv">   
            <div id="magazinereport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >MAGAZINE RECORD</Button>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getmagazine();
            $recordset=$u->getmagazine();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Magazine Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View MAGAZINE</button></a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>



        </div>
        </div>
        

     
        <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
        </script>
    </body>
</html>