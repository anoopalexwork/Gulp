<?php
echo "Starting...";
$apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
$dom = new DOMDocument();
if (!$dom) {echo "domdoc failed"; return;}
$qfood = "eggplant";
$qlist= file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/search?api_key='.$apikey.'&format=abridged&query='.$qfood);
if (!$qlist) {echo "Search error..."; return;}

$regex = "/\"fdcId\"...|\"description\".../";

//echo "qlist is ".$qlist;
$chunks = getIDList($qlist,$regex);
if (!$chunks) {echo "getIDList failed"; return false;}
//print_r($chunks);
//walkList($chunks);
cute($chunks);

function getIDList ($data,$pattern){
  $esc = preg_quote($data);
  $list = preg_split($pattern,$esc,-1, PREG_SPLIT_NO_EMPTY);

  if (!$list) { echo('preg_split failed'); return false; }

  $iList = [];
  for ($i=1;$i<count($list);$i+=2){
    $id = $list[$i];
    $desc = $list[$i+1];
    $id = substr($id,0,strpos($id,","));
    $desc = substr($desc,0,strpos($desc,"\","));


    array_push($iList,array($id,$desc));

  }
  echo "Count is ".count($iList)."\n";
  if (!is_array($iList)) {echo "iList failed"; return false;}
  return $iList;
}

function cute($list){
  $html = "<select id=\"qid\" name=\"qid\">";
  for ($i=0;$i<count($list);$i++){
    $html.="<option value=\"".$list[$i][0]."\">".$list[$i][1]."</option>";
  }
  $html.="</select>";
  echo $html;
}

function walkList($list){

  for ($i=0;$i<count($list);$i++){
    echo $list[$i][0]." ".$list[$i][1]."<BR>";
  }

}


/*
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

  $theid = substr($theid,0,$y);
  $thedesc = substr($thedesc,0,$z);
  //echo $theid.$thedesc;

  array_push($itemlist,array($theid,$thedesc));

}

foreach ($itemlist as $x) {
  echo $x[0].$x[1]."<BR>";
}

/*for ($i=0;$i<count($itemlist);$i++)
{
  echo $itemlist[$i][0];
  echo $itemlist[$i][1];
  echo "<BR>";
}*/
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
