<?php
session_start();

if (empty($_SESSION['id'])){

  echo ("fail");
  $_SESSION['message']="Please login to take an appointment";
  header ('Location: login.php');
//  echo ($_SESSION['email']);
}
if(isset($_GET['flag'])){
$flag = $_GET['flag'];
//echo $flag;
$PNAME = $_GET['PNAME'];
$prescription=$_GET['prescription'];
$diagnosis=$_GET['diagnosis'];
$date=$_GET['date'];
$fee=$_GET['fee'];
$id=$_GET['id'];
/*echo $flag;
echo $PNAME;
echo $prescription;
echo $diagnosis;
echo $date;
echo $fee;
*/
if(isset($_POST['submitAppointment'])){
  //echo ("hello\n");
// connect
$m = new MongoClient();
if ($m)
{
//echo ("hogaya");    
}

// select a database
$db = $m->awt;
// select a collection (analogous to a relational database's table)
$collection = $db->appointments;
// add a record
//echo $_POST['prescription'];

$collection->update(array('_id' => New MongoId($id)), array('$set'=>array("Prescription"=>$_POST['prescription'],"Diagnosis"=>$_POST['dignosis'],"Fee"=>$_POST['fee'])));
if($collection){
  $_SESSION['message']="Patient appointment updated Successfully.";
  echo $_SESSION['message'];
header('Location: check_appointment.php');
// find everything in the collection
/*$item = $collection->findOne(array(
    '_id' => new MongoId('4e49fd8269fd873c0a000000')));

$rangeQuery = array('_id' => New MongoId('557425262cbb9059a02f5077'));
*/
$rangeQuery = array('_id' => New MongoId($id));
//echo "ObjectId(".$id.")";
$cursor = $collection->find($rangeQuery);
// iterate through the results
foreach ($cursor as $documents) {
echo ("\n_id:".$documents["_id"] . "<br>");
echo ("Prescription :".$documents["Prescription"] . "<br>");//
echo ("Diagnosis :".$documents["Diagnosis"] . "<br>");//
echo ("Fee :".$documents["Fee"] . "<br>");
				}

}

}
if(isset($_POST['back'])){
  header('Location: check_appointment.php');
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Appointment</title>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font.css">
<link rel="stylesheet" href="css/font2.css">
<!--
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=BenchNine:300,400,700' rel='stylesheet' type='text/css'>
 -->
</head>
<body>

<!-- ====================================================
	header section -->
<header class="top-header">
  <div class="container">
    <div class="row" >
      <div class="col-xs-3 header-logo"> <br>
        <a href="index.php"><img src="img/logo.png" alt="" class="img-responsive logo"></a> </div>
      <div class="col-md-10">
        <nav class="navbar navbar-default">
          <div class="container-fluid nav-bar"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a class="menu active" href="index.php#home">Home</a></li>
                <li><a class="menu" href="index.php#about">about us</a></li>
                <li><a class="menu" href="index.php#service">our services </a></li>
                <li><a class="menu" href="index.php#team">our team</a></li>
                <li><a class="menu" href="index.php#contact"> contact us</a></li>
               
               <?php
				if(empty($_SESSION['id']))
						{
							echo "<li><a class='menu' href='signup.php'> Register</a></li>";
							echo "<li><a class='menu' href='login.php'> Login</a></li>";
							
						}
						else{
					  echo "<li><a class='menu' href='facilities.php'>Facilities</a></li>";
							echo "<li><a class='menu' href='signout.php'>Sign Out</a></li>";
							echo $_SESSION['email'];
						}
			?>
              </ul>
            </div>
            <!-- /navbar-collapse --> 
          </div>
          <!-- / .container-fluid --> 
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- end of header area -->

<section class="about text-center" id="sign_up">
<div class="container">
<div class="row" style='margin-top: 70px'>
  <h2>Appointment</h2>
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
      <form a id= "#C4" class="form-horizontal" role="form" name="appForm" method="POST">
        <div  class="form-group">
          <label class="control-label col-sm-2" for="Username">NAME:</label>
          <div class="col-sm-10">
	    <?php
	    if(isset($flag)){
	      
	    
	    if (empty($PNAME)){
	      echo " <input type='text' class='form-control' id='Username' placeholder='Enter your Name' >";
	    }
	    else{
	      echo " <input type='text' class='form-control' id='Username' value='".$PNAME."' readonly>";
	    }
	    }
	    else{
	       echo "<input type='text' class='form-control' id='Username' placeholder='Enter your Name'>";
	    }
	    ?>

          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2" for="Contact">Date</label>
          <div class="col-sm-10">
	      <?php
	     if(isset($flag)){
	      
	    if (empty($date)){
	      
	      echo "<input type='text' class='form-control' id='datefrom' placeholder='Date Format:DD-MM-YYYY'>";
	    }
	    else{
echo"<input type='text' class='form-control' id='datefrom' value='".$date."'readonly>";

	    }
	     }
	     else{
	     echo "<input type='text' class='form-control' id='datefrom' placeholder='Date Format:DD-MM-YYYY'>";
	    }
	     
	    
	    
	    ?>
	    
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="Contact">Prescription</label>
          <div class="col-sm-10">
	 
	      <?php
	    if(isset($flag)){
	    if (empty($prescription)){
	      
	      echo "<input type='text' class='form-control' id='prescription' name='prescription' placeholder='Enter your Prescription'>";
	    }
	    else{
	      echo "<input type='text' class='form-control' id='prescription' name='prescription' value='".$prescription."'>";
	    }
	    }
	    else{
	     echo "<input type='text' class='form-control' id='prescription' name='prescription' placeholder='Enter your Prescription'>";
	   
	    }
	    ?>
      </div>
        </div>
	 <div class="form-group">
          <label class="control-label col-sm-2" for="Contact">Dignosis</label>
         <div class="col-sm-10">
	       
		<?php
	   if(isset($flag)){
	    if (empty($fee)){
	      echo "<input type='text' class='form-control' id='dignosis' name='dignosis' placeholder='Enter your Dignosis'> ";
	     // echo " <input type='text' class='form-control'id='fee' name='fee' placeholder='Enter your Fee'>";
	    }
	    else{
	    //echo " <input type='text' class='form-control'id='fee' name='fee' value=".$fee.">";
	      echo "<input type='text' class='form-control' id='dignosis' name='dignosis' value='".$diagnosis."'> ";
	    }
	   }	    
	    else{
	     echo "<input type='text' class='form-control' id='prescription' name='prescription' placeholder='Enter your Prescription'>";
	    }
	    ?>
      </div>
        </div>
		
		
		<div class="form-group">
          <label class="control-label col-sm-2" for="Contact">Fee</label>
         <div class="col-sm-10">
	     
       <?php
	    if(isset($flag)){
	    if (empty($fee)){
	      
	      echo " <input type='text' class='form-control'id='fee' name='fee' placeholder='Enter your Fee'>";
	    }
	    else{
	      echo " <input type='text' class='form-control'id='fee' name='fee' value=".$fee.">";
	    }
	    }
	      else{
	     	      echo "<input type='text' class='form-control'id='fee' name='fee' placeholder='Enter your Fee'>";
	    }
	    
	    ?>
	 </div>
        </div>
		
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
	    <?php
	    if(isset($flag)){
	      
	    if($flag=="V"){
	          echo "<button type='submit' class='btn btn-default' name='submitAppointment'>Submit</button>";
		   echo "<button type='submit' class='btn btn-default' name='back'>Back</button>";
	    }
	    else if($flag=="E"){
		  echo "<button type='submit' class='btn btn-default' name='back'>Back</button>";
		  
	    }
	    	    }
		    else{
		      echo "<button type='submit' class='btn btn-default' name='back'>Back</button>";
		    }
		    

	    ?>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div>
</section>
<!-- end of about section --> 

<!-- footer starts here -->
<footer class="footer clearfix">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 footer-para">
        <p>&copy;CMS All right reserved</p>
      </div>
      <div class="col-xs-6 text-right"> <a href=""><i class="fa fa-facebook"></i></a> <a href=""><i class="fa fa-twitter"></i></a> <a href=""><i class="fa fa-skype"></i></a> </div>
    </div>
  </div>
</footer>

<!-- script tags
	============================================================= --> 
	<script src="js/jquery-2.1.1.js"></script>
	<!--<script src="http://maps.google.com/maps/api/js?sensor=true"></script>-->
	<script src="js/gmaps.js"></script>
	<script src="js/smoothscroll.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>

</body>
</html>