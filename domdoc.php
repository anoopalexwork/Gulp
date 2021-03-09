<?php
echo "Starting...";
$apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
$dom = new DOMDocument();
if (!$dom) {echo "domdoc failed"; return;}
else { echo "domdco pass";}
$qfood = "cauliflower";
//$list = file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/list?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA&query='.$qfood);
$food = file_get_contents('https://api.nal.usda.gov/fdc/v1/food/587455?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA&format=abridged');
//if ($myhtm == null) echo "not null";
//if ($myhtm == "") echo "not empty";
echo $food;

$scan = preg_quote($food);
$pattern = "/\"fdcId\"..|\"description\"..|\"dataType\"..|\"Protein\",\"amount\"..|\"Total lipid...fat..\",\"amount\"..|\"Carbohydrate, by difference\",\"amount\"..|\"Water\",\"amount\"..|\"Sugars, total including NLEA\",\"amount\"..|\"Fiber, total dietary\",\"amount\"../"; //FDC ID NumberFormatter

$components = preg_split($pattern, $scan, -1,PREG_SPLIT_NO_EMPTY);

/*
//$scan = preg_quote ("abc5def110xaz");
$scan = preg_quote($list);
$fdcid = "/\"fdcId\"/"; //FDC ID NumberFormatter

$components = preg_split($fdcid, $scan, -1,PREG_SPLIT_NO_EMPTY);
//echo $components[0]."<BR><BR>".$components[1];
*/
foreach ($components as $value) {
  echo $value."<BR><BR>";
}
//echo "<br><br>";
//echo $myhtm;
/*libxml_use_internal_errors(true);
$dom->loadHTML($myhtm);
$data = $dom->getElementByClass("result-description");
if (!$data) {echo "failed getelement<br>";return;}
if ($data == null) echo "not null";
if ($data == "") echo "not empty";

echo "<br><br>Loaded";
echo $data->nodeValue."\n";
echo "<br><br>";
function SanitizeString($var) {
  $var = strip_tags($var);
  $var =htmlentities($var);
  return stripslashes($var);
}*/
?>
