<?php


$host = "sophia";
$username="ffeichin";
$password="02121995";
$database="ffeichin";

$con = mysqli_connect($host,$username,$password);

mysqli_select_db($con, $database) or die( "Unable to select database");

if (isset($_GET['userID'])){ 

	$query = "SELECT T.transactionID, T.date, T.amount, U2.username AS receiver,
		  P.transferTo_userID, M.merchantID, M2.merchantName, M.location
		  FROM User U, Transaction T 
		  LEFT OUTER JOIN P2Ptransfer P ON T.transactionID=P.transactionID 
		  LEFT OUTER JOIN Payment P2 ON T.transactionID=P2.transactionID 
		  LEFT OUTER JOIN Mobilespot M 
	          ON M.merchantID=P2.merchantID AND M.spotID=P2.spotID
		  LEFT OUTER JOIN Merchant M2 ON M.merchantID=M2.merchantID
		  LEFT OUTER JOIN User U2 ON P.transferTo_userID=U2.userID
	          WHERE T.make_userID=U.userID
		  AND U.userID=".$_GET['userID'].";"; 

}else{ 

    $query = "SELECT U.userID, U.username FROM User U;"; 

} 


$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Homework answers</title>";
echo "</head>";
echo "<body  align=center>";

echo "<p align='center'>The answer of Q7</p>";

echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>transactionID</th>";
echo "<th>date</th>";
echo "<th>amount</th>";
echo "<th>transferred to</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['transactionID']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['amount']."</td>";
    if($row['merchantName'] == NULL) {
        echo "<td><a href='q7.php?userID=".$row['transferTo_userID']."'>".$row['receiver']."</a></td>";  
    } else {
        echo "<td><a href='q9.php?merchantID=".$row['merchantID']."'>".$row['merchantName']." ".$row['location']."</a></td>"; 
    }
echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";

mysqli_close($con);
?>
