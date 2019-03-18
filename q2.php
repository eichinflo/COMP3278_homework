<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

$query = "SELECT P.transactionID, T.date, T.amount, U.username FROM User U, P2Ptransfer P, Transaction T WHERE U.userID=P.transferTo_userID AND T.transactionID=P.transactionID AND DATE(T.date) >= DATE('2018-05-01') ORDER BY DATE(T.date) DESC;";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));


echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q2</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>transactionID</th>";
echo "<th>date</th>";
echo "<th>amount</th>";
echo "<th>username</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['transactionID']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['username']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
