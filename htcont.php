<?php
$room=$_POST['room'];
$res='';
include 'db_connect.php';
$sql = "SELECT * FROM `mesg` WHERE room='$room'";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        $res=$res . '<div class="container bubble">';
        $res=$res . ' <span class="ip time-right">' . $row['ip'] . '</span>';
        $res=$res . ' <span class="mesg">' . $row['msg']   . '</span>';
        $res=$res . '</p> <span class="tstamp time-right">' . $row['timestamp'] . "</span></div>";
      }
     
}
echo $res;
?>