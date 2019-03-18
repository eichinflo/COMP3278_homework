<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

$query = "SELECT M.merchantID, M.merchantName, C.numberOfSpots, R.totalRevenues
	  FROM Merchant M LEFT OUTER JOIN 
	   (SELECT M.merchantID, COUNT(*) AS numberOfSpots 
	    FROM Merchant M, Mobilespot S
	    WHERE M.merchantID = S.merchantID
	    GROUP BY M.merchantID) C
	   ON M.merchantID = C.merchantID LEFT OUTER JOIN
           (SELECT M.merchantID, SUM(T.amount) AS totalRevenues
            FROM Merchant M, Transaction T, Payment P
            WHERE M.merchantID=P.merchantID
            AND T.transactionID=P.transactionID
	    GROUP BY M.merchantID) R
          ON R.merchantID=M.merchantID;";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));


echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q8</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>merchantID</th>";
echo "<th>merchantName</th>";
echo "<th>numberOfSpots</th>";
echo "<th>totalRevenues</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['merchantID']."</td>";
    echo "<td><a href='q9.php?merchantID=".$row['merchantID']."'>".$row['merchantName']."</a></td>";
    echo "<td>".$row['numberOfSpots']."</td>";
    echo "<td>".$row['totalRevenues']."</td>";
    echo "</tr>";
}


echo "</table>";
echo "</body>";
echo "</html>";


mysqli_close($con);
?>
