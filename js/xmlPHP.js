//Define the asyncObj class

var asyncObj = function(file,p,t, htmlid){

  var params = p;
  //alert("p is "+p);
  var request = asyncRequest();
  if (t=="POST") {
    request.open(t, file, true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //request.setRequestHeader("Content-length", params.length); //request.setRequestHeader("Connection", "close");

  }

  else {request.open(t,file,true);}


  request.onreadystatechange = function(){
    if (this.readyState == 4) {
      if (this.status == 200) {
        if (this.responseText != null) {
          document.getElementById(htmlid).innerHTML = this.responseText;

        }
        else alert("Communication error: No data received")
      }
      else alert( "Communication error: " + this.statusText)
    }
  }
  if (t=="POST") {//alert(params);
     request.send(params);}
  else {request.send(null);}

}


this.asyncRequest = function(){

    try // Non-IE browser?
    {
        // Yes
        var request = new XMLHttpRequest();
    }
    catch(e1)
    {
      try // IE 6+?
      {
        // Yes
        request = new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch(e2)
      {
        try // IE 5?
        {
          // Yes
          request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e3) // There is no asynchronous support
        {
          request = false;
        }
      }
    }
    return request;
  }
