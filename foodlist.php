<?php
echo "Starting...";
$apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
$dom = new DOMDocument();
if (!$dom) {echo "domdoc failed"; return;}
else { echo "domdco pass";}
$qfood = "eggplant";
//$list = file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/list?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA&query='.$qfood);
$food = file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/search?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA&format=abridged&query='.$qfood);
//if ($myhtm == null) echo "not null";
//if ($myhtm == "") echo "not empty";
//echo $food;

$scan = preg_quote($food);
//$pattern = "/\"fdcId\"..|\"description\"..|\"dataType\"../"; //FDC ID NumberFormatter
$foodIDs = "/\"fdcId\"../";
$desc = "/\"description\"../";
$iddesc = "/\"fdcId\"...|\"description\".../";
//$idlist = preg_split($foodIDs, $scan, -1,PREG_SPLIT_NO_EMPTY);
//$desclist = preg_split($desc, $scan, -1,PREG_SPLIT_NO_EMPTY);
$reglist = preg_split($iddesc, $scan, -1,PREG_SPLIT_NO_EMPTY);
echo "gotreg...";
$il = 0;
//print_r($reglist);

$item = array();
$ilist = array();
$itemlist = array();
$il=0;
for ($i=1;$i<count($reglist);$i+=2){
  //echo $reglist[$i];
  $theid = $reglist[$i];
  $thedesc = $reglist[$i+1];
  //echo $theid;
  $y= strpos($theid,",");
  $z = strpos($thedesc,"\",");

  $theid = substr($theid,0,$y)." ";
  $thedesc = substr($thedesc,0,$z)."<BR>";
  echo $theid.$thedesc;
}
  //$item = array($reglist[i],$reglist[i+1]);
  /*echo $reglist[i]."<BR>".$reglist[i+1]."<BR><BR>";
  array_push($ilist,$item);
  //echo $ilist[$il][0][0]."<BR><BR>";
  $il++;
  //echo "..savfed..";

  //$il++;
}
echo count($item);
echo count($ilist);

//print_r( $ilist);

//print_r($ilist);
/*
//$scan = preg_quote ("abc5def110xaz");
$scan = preg_quote($list);
$fdcid = "/\"fdcId\"/"; //FDC ID NumberFormatter

$components = preg_split($fdcid, $scan, -1,PREG_SPLIT_NO_EMPTY);
//echo $components[0]."<BR><BR>".$components[1];
*/

/*
$id = array();
foreach ($idlist as $x) {
   array_push($id,$x);
   echo "<BR>----------------".$x."-------------------<BR><BR>";

}

$desc = array();
foreach ($desclist as $x) {
   array_push($desc,$x);

}
*/

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
