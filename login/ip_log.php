<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
  ini_set("session.cache_expire", 43200);  
  ini_set("session.cookie_lifetime", 43200);  
  session_start();
  $con=mysqli_connect("localhost","ID","PW","DB NAME");
  $ip =  $_SERVER['REMOTE_ADDR'];
  $today = date("Y-m-d H:i:s");
  exec("arp -H ether -n -a ".$REMOTE_ADDR."",$values);
  $parts = explode(' ',$values[0]);

// Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql="INSERT INTO log VALUES ('$today', '$ip' , '$parts[3]')";

  if (!mysqli_query($con,$sql))
  {
    die('Error: ' . mysqli_error($con));
  }
  mysqli_close($con);
  header('Location: ./index.php');   
?>
