<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

$query = "SELECT M.merchantID, M.merchantName, SUM(T.amount) AS cost FROM Merchant M, Payment P, Transaction T WHERE M.merchantID = P.merchantID AND T.transactionID = P.transactionID AND T.make_userID=1 GROUP BY M.merchantID ORDER BY M.merchantID ASC;";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));


echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q4</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>merchantID</th>";
echo "<th>merchantName</th>";
echo "<th>cost</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['merchantID']."</td>";
    echo "<td>".$row['merchantName']."</td>";
    echo "<td>".$row['cost']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
