<?php

$room=$_POST['room'];
validateForm($room);


function validateForm($room) {
    
    if (strlen($room) > 20 or strlen($room) < 4 ) {
     echo '<script language="javascript">';
       echo ' alert("The roomname should have 4-20 characters");';
      echo 'window.location="http://localhost/mychatapp";';
      echo '</script>';
    }
 

  elseif (!ctype_alnum($room)) {
    echo '<script language="javascript">';
    echo ' alert("The roomname should only contain alpha-numeric characters");';
   echo 'window.location="http://localhost/mychatapp";';
   echo '</script>';
  }


  else
  {
      include 'db_connect.php';
  }

  $sql = "SELECT * FROM `dbroom` WHERE roomname='$room'";
  $result = $conn->query($sql);
 if ($result) {
     
  if ($result->num_rows > 0)
  {
    echo '<script language="javascript">';
    echo ' alert("Please Choose a different name, this room is already taken");';
   echo 'window.location="http://localhost/mychatapp";';
   echo '</script>';
  }
  else {
   $sql= "INSERT INTO `dbroom` ( `roomname`, `timestamp`) VALUES ('$room', CURRENT_TIMESTAMP)";
   $conn->query($sql);
   echo '<script language="javascript">';
    echo ' alert("Your room is ready, You can chat now!");';
   echo 'window.location="http://localhost/mychatapp/rooms.php?room='.$room.'";';
   echo '</script>';
  }
 }
 

}




?>