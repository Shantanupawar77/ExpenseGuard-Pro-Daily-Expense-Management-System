<?php
$con = mysqli_connect("127.0.0.1","root","","dailyexpense3");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() ." | Seems like you haven't created the DATABASE with an exact name";
  }
?>