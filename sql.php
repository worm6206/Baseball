<?php
$servername = "127.0.0.1";
$username = "root";
$password = "6570";
$dbname = "Lahman2015";
$sql = "SELECT B.franchID, B.`franchName`, A.W
FROM Teams A INNER JOIN TeamsFranchises B ON A.franchID = B.franchID
WHERE A.yearID = 2014
ORDER BY A.W DESC
";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo $row["franchID"]. "," . $row["W"]. "</br>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>