
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
 foreach ($results as $result) {
    $status=$result->Status;
    $_SESSION['eid']=$result->id;
  } 
    if($status==0)
    {
    $msg="Your account is Inactive. Please contact admin";
    } else{
    $_SESSION['emplogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
    } 
}else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

