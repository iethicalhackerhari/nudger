<?php
$roomName=$_GET['room'];
include 'db_connect.php';

$sql = "SELECT * FROM `dbroom` WHERE roomname='$roomName'";
  $result = $conn->query($sql);

if ($result) {
    if ($result->num_rows === 0)
    {
      echo '<script language="javascript">';
      echo ' alert("Room Does not exist.");';
     echo 'window.location="http://localhost/mychatapp";';
     echo '</script>';
    }
}
else {
    echo "Error:". $conn->connect_error();
}

?>


<!DOCTYPE html>
<html>
<head>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/chat.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.scroll-div{
    height: 350px;
    overflow-y:scroll;
    
}
</style>

</head>
<body>
<h2>Chat Messages</h2>
<h3>Room : <?php echo $roomName; ?></h3>

<div class="container bg-light">
    <div class="scroll-div">
 
</div>
</div>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Message">
<br>
<button class="btn btn-dark " name="submitmsg" id="submitmsg">Send</button>


<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">

setInterval(() => {
    $.post('htcont.php',{room:'<?php echo $roomName ?>'},
    (data,status)=>{
        document.getElementsByClassName('scroll-div')[0].innerHTML=data;
        document.getElementsByClassName('scroll-div')[0].scrollTop = document.getElementsByClassName('scroll-div')[0].scrollHeight;
    })
}, 1000);

 
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
    
  }
});
   
    $("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
  $.post("postmsg.php", {text : clientmsg, room:'<?php echo $roomName ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'
  },(data,status)=>{
      document.getElementsByClassName('scroll-div')[0].innerHTML =data;});
      $("#usermsg").val('');
      return false;
});

</script>

</body>
</html>
