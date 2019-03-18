<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

$query = "SELECT groupID, groupName FROM Vgroup;";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>Q6 submission form</p>";

echo "<form action='q6.php' method='GET' align='center'>";
echo "<p> Select group: </p>";
echo "<select name='group'>"; 

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
{ 
echo "<option value='".$row['groupID']."'>";     
echo $row['groupID'].":".$row['groupName'];
echo "</option>";
}

echo "</select>";

echo "<input type='submit'>";

echo "</form>"; 

echo "</body>";
echo "</html>";


mysqli_close($con);
?>
