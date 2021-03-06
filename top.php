<html>

<head>
    <link rel="stylesheet" href="css/list.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/gulp.js"></script>
    <script>
      params = "url=news.com";
      request = new asyncRequest();
      request.open("POST", "urlpost.php", true);
      request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      request.setRequestHeader("Content-length", params.length);
      request.setRequestHeader("Connection", "close");
      request.onreadystatechange = function(){
        if (this.readyState == 4)
{
if (this.status == 200)
{
if (this.responseText != null)
{
document.getElementById('info').innerHTML =
this.responseText
}
else alert("Communication error: No data received")
}
else alert( "Communication error: " + this.statusText)
}
}


request.send(params);


      function asyncRequest() {
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
    </script>
</head>
