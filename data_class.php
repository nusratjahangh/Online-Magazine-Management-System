<?php include("db.php");

class data extends db {

    private $magazinepic;
    private $magazinename;
    private $magazinedetail;
    private $magazineaudor;
    private $magazinepub;
    private $branch;
    private $magazineprice;
    private $magazinequantity;
    private $type;

    private $magazine;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;





    function __construct() {
        // echo " constructor ";
        echo "</br></br>";
    }


    function addnewuser($name,$pasword,$email,$type){
        $this->name=$name;
        $this->pasword=$pasword;
        $this->email=$email;
        $this->type=$type;


         $q="INSERT INTO userdata(id, name, email, pass,type)VALUES('','$name','$email','$pasword','$type')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=New Add done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=Register Fail");
        }



    }
    function userLogin($t1, $t2) {
        $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: otheruser_dashboard.php?userlogid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }

    function adminLogin($t1, $t2) {

        $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: admin_service_dashboard.php?logid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }



    function addmagazine($magazinepic, $magazinename, $magazinedetail, $magazineaudor, $magazinepub, $branch, $magazineprice, $magazinequantity) {
        $this->$magazinepic=$magazinepic;
        $this->magazinename=$magazinename;
        $this->magazinedetail=$magazinedetail;
        $this->magazineaudor=$magazineaudor;
        $this->magazinepub=$magazinepub;
        $this->branch=$branch;
        $this->magazineprice=$magazineprice;
        $this->magazinequantity=$magazinequantity;

       $q="INSERT INTO magazine (id,magazinepic,magazinename, magazinedetail, magazineaudor, magazinepub, branch, magazineprice,magazinequantity,magazineava,magazinerent)VALUES('','$magazinepic', '$magazinename', '$magazinedetail', '$magazineaudor', '$magazinepub', '$branch', '$magazineprice', '$magazinequantity','$magazinequantity',0)";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }

    }


    private $id;



    function getpurchasemagazine($userloginid) {

        $newfine="";
        $purchasereturn="";

        $q="SELECT * FROM purchasemagazine where userid='$userloginid'";
        $recordSetss=$this->connection->query($q);


        foreach($recordSetss->fetchAll() as $row) {
            $purchasereturn=$row['purchasereturn'];
            $fine=$row['fine'];
            $newfine= $fine;

            
                //  $newbookrent=$row['bookrent']+1;
        }


        $getdate= date("d/m/Y");
        if($purchasereturn<$getdate){
            $q="UPDATE purchasemagazine SET fine='$newfine' where userid='$userloginid'";

            if($this->connection->exec($q)) {
                $q="SELECT * FROM purchasemagazine where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;
            }
            else{
                $q="SELECT * FROM purchasemagazine where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;  
            }

        }
        else{
            $q="SELECT * FROM purchasemagazine where userid='$userloginid'";
            $data=$this->connection->query($q);
            return $data;

        }






    }

    function getmagazine() {
        $q="SELECT * FROM magazine ";
        $data=$this->connection->query($q);
        return $data;
    }
    function getmagazinepurchase(){
        $q="SELECT * FROM magazine where magazineava !=0 ";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdata() {
        $q="SELECT * FROM userdata ";
        $data=$this->connection->query($q);
        return $data;
    }


    function getmagazinedetail($id){
        $q="SELECT * FROM magazine where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdetail($id){
        $q="SELECT * FROM userdata where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }



    function requestmagazine($userid,$magazineid){

        $q="SELECT * FROM magazine where id='$magazineid'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $username=$row['name'];
            $usertype=$row['type'];
        }

        foreach($recordSetss->fetchAll() as $row) {
            $magazinename=$row['magazinename'];
        }

        if($usertype=="author"){
            $days=7;
        }
        if($usertype=="teacher"){
            $days=21;
        }


        $q="INSERT INTO requestmagazine (id,userid,magazineid,username,usertype,magazinename,purchasedays)VALUES('','$userid', '$magazineid', '$username', '$usertype', '$magazinename', '$days')";

        if($this->connection->exec($q)) {
            header("Location:otheruser_dashboard.php?userlogid=$userid");
        }

        else {
            header("Location:otheruser_dashboard.php?msg=fail");
        }

    }


    function returnmagazine($id){
        $fine="";
        $magazineava="";
        $purchasemagazine="";
        $magazinerentel="";

        $q="SELECT * FROM purchasemagazine where id='$id'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $userid=$row['userid'];
            $purchasemagazine=$row['purchasemagazine'];
            $fine=$row['fine'];

        }
        if($fine==0){

        $q="SELECT * FROM magazine where magazinename='$purchasemagazine'";
        $recordSet=$this->connection->query($q);   

        foreach($recordSet->fetchAll() as $row) {
            $magazineava=$row['magazineava']+1;
            $magazinerentel=$row['magazinerent']-1;
        }
        $q="UPDATE magazine SET magazineava='$magazineava', magazinerent='$magazinerentel' where magazinename='$purchasemagazine'";
        $this->connection->exec($q);

        $q="DELETE from purchasemagazine where id=$id and purchasemagazine='$purchasemagazine' and fine='0' ";
        if($this->connection->exec($q)){
    
            header("Location:otheruser_dashboard.php?userlogid=$userid");
         }
        //  else{
        //     header("Location:otheruser_dashboard.php?msg=fail");
        //  }
        }
        // if($fine!=0){
        //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
        // }
       

    }

    function delteuserdata($id){
        $q="DELETE from userdata where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

    function deletemagazine($id){
        $q="DELETE from magazine where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

        function purchasereport(){
            $q="SELECT * FROM purchasemagazine ";
            $data=$this->connection->query($q);
            return $data;
            
        }

        function requestmagazinedata(){
            $q="SELECT * FROM requestmagazine ";
            $data=$this->connection->query($q);
            return $data;
        }

      // issue issuebookapprove
      function purchasemagazineapprove($magazine,$userselect,$days,$getdate,$returnDate,$redid){
        $this->$magazine= $magazine;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM magazine where magazinename='$magazine";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $purchaseid=$row['id'];
                $purchasetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $magazineid=$row['id'];
                $magazinename=$row['magazinename'];

                    $newmagazineava=$row['magazineava']-1;
                     $newmagazinerent=$row['magazinerent']+1;
            }

       
            $q="UPDATE magazine SET magazineava='$newmagazineava', magazinerent='$newmagazinerent' where id='$magazineid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO purchasemagazine (userid,purchasename,purchasemagazine,purchasetype,purchasedays,purchasedate,purchasereturn,fine)VALUES('$purchaseid','$userselect','$magazine','$purchasetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {

                $q="DELETE from requestmagazine where id='$redid'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }




        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
    
    // issue book
    function purchasemagazine($magazine,$userselect,$days,$getdate,$returnDate){
        $this->$magazine= $magazine;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM magazine where magazinename='$magazine'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $purchaseid=$row['id'];
                $purchasetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $magazineid=$row['id'];
                $magazinename=$row['magazinename'];

                    $newmagazineava=$row['magazineava']-1;
                     $newmagazinerent=$row['magazinerent']+1;
            }

        
            $q="UPDATE magazine SET magazineava='$newmagazineava', magazinerent='$newmagazinerent' where id='$magazineid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO purchasemagazine (userid,purchasename,purchasemagazine,purchasetype,purchasedays,purchasedate,purchasereturn,fine)VALUES('$purchaseid','$userselect','$magazine','$purchasetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }


        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
}