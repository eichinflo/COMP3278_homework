<?php

$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

// Step 1. Connect to database server
$con = mysqli_connect($host,$username,$password);

// Step 2. Select the database we work on
mysqli_select_db($con, $database) or die( "Unable to select database");

// Step 3. Prepare the database query
$query = "SELECT userID, username, accountBalance FROM User WHERE userID='1';";

// Step 4. Execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q1</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>userID</th>";
echo "<th>username</th>";
echo "<th>accountBalance</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	    echo "<tr>";
	        echo "<td>".$row['userID']."</td>";
	        echo "<td>".$row['username']."</td>";
		    echo "<td>".$row['accountBalance']."</td>";
		    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";

mysqli_close($con);
?>
