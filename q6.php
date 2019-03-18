<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

if (isset($_GET['group'])){ 

    $query = "SELECT U.userID, U.username FROM User U, Member_in_group M WHERE M.userID=U.userID AND M.groupID=".$_GET['group']." ;"; 

}else{ 

    $query = "SELECT U.userID, U.username FROM User U;"; 

} 


$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));


echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q6</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>userID</th>";
echo "<th>username</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<tr>";
echo "<td>".$row['userID']."</td>";
echo "<td><a href='q7.php?userID=".$row['userID']."'>".$row['username']."</a></td>";
echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
