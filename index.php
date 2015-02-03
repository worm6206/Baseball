<?php
echo "<h2>2014 Season Ranking</h2> <br>";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>League</th><th>Name</th><th>Win</th><th>Lose</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='border:0px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "127.0.0.1";
$username = "root";
$password = "6570";
$dbname = "Lahman2015";
$sqlquery = "SELECT A.lgID, B.franchName, A.W, A.L
			FROM Teams A INNER JOIN TeamsFranchises B ON A.franchID = B.franchID
			WHERE A.yearID = 2014
			ORDER BY A.W DESC";

echo "SQL Query : ";
echo $sqlquery;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sqlquery); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>