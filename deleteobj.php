<?php
include 'db.php';

if(isset($_POST['status'])=="delete"){
  $meeting_id=$_POST['meetingID'];
  $query = "DELETE FROM Meetings_207 WHERE Meet_id=".$meeting_id ;
  $result=mysqli_query($connection, $query);
  echo $query;

mysqli_close($connection);
}
?>
