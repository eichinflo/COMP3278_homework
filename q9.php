<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

if (isset($_GET['merchantID'])) {
	$query = "SELECT S.spotID, SUM(T.amount) AS revenue, S.location
		  FROM Mobilespot S
		  LEFT OUTER JOIN Payment P ON P.spotID=S.spotID AND P.merchantID=S.merchantID
		  LEFT OUTER JOIN Transaction T ON T.transactionID=P.transactionID
                  WHERE S.merchantID=".$_GET['merchantID']."
		  GROUP BY S.spotID
		  ORDER BY S.spotID DESC;";

	
	$query2 = "SELECT T.transactionID, P.spotID, T.date, T.amount
	           FROM Transaction T, Payment P
	           WHERE T.transactionID=P.transactionID
                   AND P.merchantID=".$_GET['merchantID'].";";
} else {
	$query = "";
	$query2 = "";
}


$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

$result2 = mysqli_query($con,$query2) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q9</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>spotID</th>";
echo "<th>revenue</th>";
echo "<th>location</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['spotID']."</td>";
    echo "<td>".$row['revenue']."</td>";
    echo "<td>".$row['location']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>transactionID</th>";
echo "<th>spotID</th>";
echo "<th>date</th>";
echo "<th>amount</th>";
echo "</tr>";

while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row2['transactionID']."</td>";
    echo "<td>".$row2['spotID']."</td>";
    echo "<td>".$row2['date']."</td>";
    echo "<td>".$row2['amount']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
