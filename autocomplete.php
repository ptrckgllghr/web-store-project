<?php

 $search->$q=$_GET['term'];
 $data=mysql_real_escape_string($search);
 $conn = new mysqli('localhost', 'plotkinm', 'FaceBooK', 'plotkinm_db');
 
 
 $sql="SELECT city FROM US_Zip_Codes WHERE city LIKE '%$data%'";
 
 
 $result = mysqli_query($conn,$sql);

 if($result)
 {
  while($row=mysqli_fetch_array($result))
  {
   echo $row['city']."\n";
  }
 }
?>
