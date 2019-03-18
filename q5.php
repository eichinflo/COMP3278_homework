<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

$query = "SELECT T.transactionID, T.date, T.amount  FROM User U, Transaction T WHERE T.make_userID=U.userID AND U.username='tom' AND T.amount > 10 ORDER BY DATE(T.date) DESC, T.amount ASC;";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));


echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q5</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>transactionID</th>";
echo "<th>date</th>";
echo "<th>amount</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['transactionID']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
