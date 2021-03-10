<?php

  $apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
  $dom = new DOMDocument();
  if (!$dom) {echo "domdoc failed"; return;}
  $qfood = $_POST["q"];
  $qlist= file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/search?api_key='.$apikey.'&format=abridged&query='.$qfood);
  if (!$qlist) {echo "Search error..."; return;}

  $regex = "/\"fdcId\"...|\"description\".../";

  //echo "qlist is ".$qlist;
  $chunks = getIDList($qlist,$regex);
  if (!$chunks) {echo "getIDList failed"; return false;}
  //print_r($chunks);
  //walkList($chunks);
  echo htmlSelect($chunks);




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
    if (!is_array($iList)) {echo "iList failed"; return false;}
    return $iList;
  }

  function htmlSelect($list){
    $html = "<select id=\"qid\" name=\"qid\">";
    for ($i=0;$i<count($list);$i++){
      $html.="<option value=\"".$list[$i][0]."\">".$list[$i][1]."</option>";
    }
    $html.="</select>";
    return $html;
  }

  function walkList($list){

    for ($i=0;$i<count($list);$i++){
      echo $list[$i][0]." ".$list[$i][1]."<BR>";
    }

  }



?>
