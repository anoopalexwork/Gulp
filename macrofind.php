<?php
  $apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
  $dom = new DOMDocument();
  if (!$dom) {echo "domdoc failed"; return;}
  $qfid = $_GET["qfid"];
  //echo "qfid".$qfid."<BR>";
  //echo "got q\n";
  //$qfid = "1169910";

//$qlist = file_get_contents('https://api.nal.usda.gov/fdc/v1/food/522359?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA');
  $qlist= file_get_contents('https://api.nal.usda.gov/fdc/v1/food/'.$qfid.'?api_key='.$apikey);


  //if (!$qlist) {echo "Search error..."; return false;}


  //echo $qlist;
  //echo "qlist is ".$qlist;
  $chunks = getMacros($qlist);
  //print_r($chunks);
  //echo $chunks[1];
  //echo $chunks;


  function getMacros ($data){
    $esc = preg_quote($data);
    $regex = "/lipid/";
    $list = preg_split($regex,$esc,-1, PREG_SPLIT_NO_EMPTY);
    //echo $esc;
    if (!$list) { echo('fat preg_split failed'); return false; }
    $fat = $list[1];
    //echo $fat."<BR>";
    $fat = getAmount($fat);
    echo "fatamt is ".$fat."<BR>";

    $regex = "/Protein/";
    $list = preg_split($regex,$esc,-1, PREG_SPLIT_NO_EMPTY);
    //echo $esc;
    if (!$list) { echo('prot preg_split failed'); return false; }
    $prot = $list[1];
    //echo $fat."<BR>";
    $prot = getAmount($prot);
    echo "protamt is ".$prot."<BR>";
    //$regex =
    //echo "listfat".$fat."<BR>";
    /*$amtpos = strpos($fat,"amount\"\\:");
    echo "amount fat pos:".  $amtpos."<BR>";
    $fat = substr($fat,$amtpos+9,strpos($fat,"\\"));
    //print_r($list);
    */

    //return $fat;
    //*/
  }

  function getAmount($str){
    $start = "amount\"\\:";
    //$end =
    $startpos = strpos($str,$start)+strlen($start);
    //echo "amount fat pos:".  $startpos."<BR>";
    $endpos = strpos($str,"\\.");
    //echo "endpos ".$endpos."<BR>";
    $str = substr($str,$startpos,$endpos-$startpos);
    return $str;

  }
?>
