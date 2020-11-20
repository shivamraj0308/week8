<?php
include("dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Sign Up</title>
 <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
 <link rel="stylesheet" href="css/register.css">
 <style>
body {
 background-image: url('images.jpg');
 background-repeat: no-repeat;
}
</style>
</head>
<body>
 <div class="main">
 <div class="container">
 <div class="booking-content">
 <div class="booking-image">
 <img class="booking-img" src="img.jpg" alt="Booking Image" >
 </div>
 <div class="booking-form">
 <form method="post" name="signup" id="booking-form" onSubmit="return valid();">
 <div class="form-group form-input">
 <input type="text" class="form-control" name="username" placeholder="Username" id="username"
onBlur="checkusernameAvailability()" required="required">
 <span id="user-name-availability-status" style="font-size:12px;"></span>
 </div>
<div class="form-group form-input" >
 <input type="text" class="form-control" minlength="7" maxlength="8" name="idno" id="idno"
onBlur="checkidAvailability()" placeholder="ID No *" value="" required />
 <span id="user-id-availability-status" style="font-size:12px;"></span>
 </div>
 <div class="form-group form-input ">
 <input type="text" class="form-control" minlength="10" maxlength="10" name="mobileno"
placeholder="Mobile Number" maxlength="10" required="required">
 </div>
 <div class="form-group form-input">
 <input type="email" class="form-control" name="emailid" id="emailid"
onBlur="checkemailAvailability()" placeholder="Email Address" required="required">
 <span id="user-email-availability-status" style="font-size:12px;"></span>
 </div>
 <div class="form-group form-input">
 <input type="password" class="form-control" name="password" placeholder="Password"
required="required">
 </div>
 <div class="form-group form-input">
 <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password"
required="required">
 </div>
 <div class="form-group checkbox">
 <input type="checkbox" id="terms_agree" required="required" checked="">
 <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
 </div>
 <div class="form-group form-submit">
 <input type="submit" value="Sign Up" name="signup" id="submit" class="submit">
 </div></form>
57
 </div>
 </div>
 </div>
</div>
<?php
if(isset($_POST['signup']))
{
$username=$_POST['username'];
$email=$_POST['emailid'];
$mobile=$_POST['mobileno'];
$idno=$_POST['idno'];
$password=md5($_POST['password']);
$sql="INSERT INTO tblusers(username,EmailId,ContactNo,IdNo,Password)
VALUES(:username,:email,:mobile,:idno,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':idno',$idno,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Registration successfull. Now you can login');</script>";
}
else
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
?>
<?php
?>
<script>
//This function checks email-availability-status
function checkemailAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-email-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
function checkidAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'idno='+$("#idno").val(),
type: "POST",
success:function(data){
$("#user-id-availability-status").html(data);
$("#loaderIcon").hide();
58
},
error:function (){}
});
}
function checkusernameAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#user-name-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
 <script src="js/jquery.min.js"></script>
