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
    $fat = getItem($esc,"/lipid/");
    $satfat = getItem($esc,"/al saturated/");
    $goodfat = (($fat-$satfat)/$fat)*100;
    echo "Fat:".$fat."<BR>";
    $carb = getItem($esc,"/Carbohydrate, by difference/");
    echo "Carbs:".$carb."<BR>";
    $prot = getItem($esc,"/Protein/");
    echo "Protein:".$prot."<BR>";
    $water = getItem($esc,"/Water/");
    echo "Water:".$water."<BR>";
    $sweet = getItem($esc,"/Sugar/");
    echo "Sugar:".$sweet."<BR>";
    $fiber = getItem($esc,"/Fiber/");
    echo "Fiber:".$fiber."<BR>";
    echo "Good fat%: ".$goodfat."<BR>";
    echo "Good carbs%: ".((($carb-$sweet)/$carb)*100)."<BR>";
    /*
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

  function getItem($data, $regexp)
  {
    $list = preg_split($regexp,$data,-1, PREG_SPLIT_NO_EMPTY);
    if (!$list) { echo('$regex preg_split failed'); return false; }

    $item = $list[1];
    $amt = getAmount($item);
    //echo "amount is ".$amt."<BR>";
    return $amt;
  }

  function getAmount($str){
    $start = "amount\"\\:";
    //$end =
    $startpos = strpos($str,$start)+strlen($start);
    //echo "amount fat pos:".  $startpos."<BR>";
    $endpos = strpos($str,"\\.");
    //echo "endpos ".$endpos."<BR>";
    $str = substr($str,$startpos,$endpos-$startpos);
    if (strlen($str)>3){
      $expos = strpos($str,"E");
      $str = substr($str,0,$expos);
      if (strlen($str) > 3){
        $slashpos = strpos($str,"\\");
        $str = substr($str,0,$slashpos);
      }
    }
    return $str;

  }
?>
