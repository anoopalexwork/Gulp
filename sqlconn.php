<?php
$hn = "localhost";
$db = "gulp";
$un = "root";
$pw = "sanct123";

echo "Connecting...";


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

echo "Connected....";

$query = "SELECT * FROM dayinfo";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
$rows = $result->num_rows;
echo "Selected....<br><br>";

for ($j = 0 ; $j < $rows ; ++$j) {
echo "getting....<br>";
  $result->data_seek($j);

  echo 'Date: '.htmlspecialchars($result->fetch_assoc()['date']) .'<br>';

  $result->data_seek($j);
  echo 'Name: '.htmlspecialchars($result->fetch_assoc()['name']).'<br>';

  $result->data_seek($j);
  echo 'Amount: '.htmlspecialchars($result->fetch_assoc()['amt']).'<br><br>';
  $result->data_seek($j);
}
$result->close();
echo "Closed selection....";
$conn->close();
echo "Closed connection.";

?>
