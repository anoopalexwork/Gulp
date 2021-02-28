<?php include("top.php"); ?>

<body onload="setupBody()">
    <h1 id="headline"></h1>
    <section>
        <table id="mainMenu"><tr><td id="dateBox"><b><input id="selectDate" type="date"></input></b></td><td id="foodBox">Food</td><td id="kgBox">Weight</td></tr></table>
    </section>

    <section id="bfast">
      <h2><b>Breakfast</b><br></h2>
      <hr>
      <button class="addNew" onclick="newFood = new Food('bfast'); today.add(newFood,'bfast'); ">Add New</button></h2><br>
    </section>


    <section id="lunch">
      <h2><b>Lunch</b><br></h2>
      <hr>
      <button class="addNew" onclick="newFood = new Food('lunch'); today.add(newFood,'lunch');">Add New</button><br>
    </section>

    <section id="dinner">
      <p><h2><b>Dinner</b><br>
      <hr>
      <button class="addNew" onclick="newFood = new Food('dinner'); today.add(newFood,'dinner');">Add New</button></p></h2><br>
    </section>

    <section id="extras">
      <p><h2><b>Extras</b><br>
      <hr>
      <button class="addNew" onclick="newFood = new Food('extras'); today.add(newFood,'extras');">Add New</button></p></h2><br>
    </section>

</body>
</html>
