<?php
$hn = "localhost";
$db = "gulp";
$un = "root";
$pw = "sanct123";

echo "Connecting...";


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

echo "Connected....";
//if (isset($_POST['q'])) $query = $_POST['q'];
$query = "SELECT * FROM Nutrition;";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
$rows = $result->num_rows;
echo "Selected....<br><br>";

for ($j = 0 ; $j < $rows ; ++$j) {
echo "getting....<br>";
  $result->data_seek($j);

  echo 'FCDid: '.htmlspecialchars($result->fetch_assoc()['fid']) .'<br>';

  $result->data_seek($j);
  echo 'Name: '.htmlspecialchars($result->fetch_assoc()['name']).'<br>';

  $result->data_seek($j);
  echo 'Fat: '.htmlspecialchars($result->fetch_assoc()['fat']).'<br><br>';
  $result->data_seek($j);
}
$result->close();
echo "Closed selection....";
$conn->close();
echo "Closed connection.";

?>
*/
