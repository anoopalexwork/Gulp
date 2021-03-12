<?php

  $apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
  $dom = new DOMDocument();
  if (!$dom) {echo "domdoc failed"; return;}
  $qfood = $_POST["q"];
  //$qfood= substr($qfood,0,strpos($qfood,"="));
  //$qfood="cho";
  //echo $qfood."<BR>";
  //echo "got q\n";


  $qlist= file_get_contents('https://api.nal.usda.gov/fdc/v1/foods/search?api_key='.$apikey.'&pageSize=150&format=abridged&query='.$qfood);
  if (!$qlist) {echo "Search error..."; return;}

  $regex = "/\"fdcId\"..|\"description\".../";

  //echo "qlist is ".$qlist;
  $chunks = getIDList($qlist,$regex); //get 2 column array of ids & descs
  //$nodupes = cleanList($chunks); //Remove dupes a capitalize
  if (!$chunks) {echo "No results"; return false;}
  //print_r($chunks);
  //walkList($chunks);
  echo htmlSelect($chunks);




  function getIDList ($data,$pattern){
    $esc = preg_quote($data);
    $list = preg_split($pattern,$esc,-1, PREG_SPLIT_NO_EMPTY);

    if (!$list) { echo('preg_split failed'); return false; }

    $iList = [];
    $noDupes = [];
    for ($i=1;$i<count($list);$i+=2){
      $id = $list[$i];
      $desc = $list[$i+1];
      $id = substr($id,0,strpos($id,","));
      $desc = substr($desc,0,strpos($desc,"\","));
      $desc = str_replace("\\-","-",$desc);
      $desc = str_replace("\\(","(",$desc);
      $desc = str_replace("\\)",")",$desc);
      $desc = strtolower($desc);
      //echo "Checking name";
      if (!matchName($noDupes,$desc)) {
        array_push($noDupes,$desc);
        $desc[0] = strtoupper($desc[0]);
        array_push($iList,array($id,$desc));
        //echo "Added to both lists";
      }
      if (count($iList)==50) return $iList;
    }
    if (!is_array($iList)) {echo "iList failed"; return false;}
    return $iList;
  }

  function matchName($list,$str){
    for ($i=0;$i<count($list);$i++){
      if ($str == $list[$i]) { return true;}
    }
    //echo "No match";
    return false;
  }

  function htmlSelect($list){
    $html = "<select id=\"qid\" name=\"qid\" onclick=\"dataObj = new asyncObj('macrofind.php?qfid='+this.value,'','GET','macro');\">";
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
