//Define the asyncObj class

var asyncObj = function(file,p,txt){
var def = txt;
var params = p+"="+txt;
var request = asyncRequest();
request.open("POST", file, true);
request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//request.setRequestHeader("Content-length", params.length);
//request.setRequestHeader("Connection", "close");


request.onreadystatechange = function(){
  if (this.readyState == 4)
{
if (this.status == 200)
{
if (this.responseText != null)
{
  document.getElementById('info').innerHTML = this.responseText;

}
else alert("Communication error: No data received")
}
else alert( "Communication error: " + this.statusText)
}
}

request.send(params);

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
