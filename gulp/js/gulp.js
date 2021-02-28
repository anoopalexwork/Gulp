function Food(time) {

  this.time = time;
  this.name = prompt("Name:");
  this.amount = prompt("Amount:");

}

function dayList() {
        //Create lists for different times
        this.bfast = new Array();
        this.lunch = new Array();
        this.dinner = new Array();
        this.extras = new Array();
        this.suggest = new Array();
        const title = {"bfast":"Breakfast", "lunch":"Lunch", "dinner":"Dinner", "extras":"Extras"};

        //Add a new Food object to the list
        this.add= function (newFood,time){
            var fItem;

            currTable = this.timeTable(time);
            fname  = newFood.name;
            famt = newFood.amount;

            currTable.push(newFood);

            this.redraw(time);

        }

        //return the correct list for the time parameter
        this.timeTable= function(time){
            switch(time){
                case 'bfast': return this.bfast;
                case 'lunch': return this.lunch;
                case 'dinner':return this.dinner;
                case 'extras': return this.extras;
            }

        }

        //Delete the Food item at the specified index and redraw the list
        this.delete = function(idx, time){
            currTable = this.timeTable(time);
            currTable.splice(idx,1);

            this.redraw(time);

        }

        //Redraw the specified list on the page. It basically edits the innerHTML value of the
        //specificed time section of the page. Creates the foodlist and adds click event functions
        //to delete and add to the list
        this.redraw = function(time){
            var itemText = "";
            var titleText = title[`${time}`];


            currList = this.timeTable(time);


            for (fItem in currList){

                itemText+=`<section class="foodLine"><section class="name">${currList[fItem].name}</section><section class="amt">${currList[fItem].amount}</section><section class="rem"><button class="editBtn" onclick="today.delete(${fItem},'${time}');" >Remove</button></section></section>`;

            }

            var sect = document.getElementById(`${time}`);

            sect.innerHTML=`<section><h2><b>${titleText}</b></h2><section class="foodList ${time}Table">`+itemText+`</section></section><section><button class="addNew" onactive="newFood = new Food('${time}'); today.add(newFood,'${time}');" onclick="newFood = new Food('${time}'); today.add(newFood,'${time}'); ">Add New</button></section><br><br>`;
        }
    }

//new editable object made up of four lists for breakfast, lunch, dinner and extras
today = new dayList();

//Return text version of current Date object for the day
function date2Text(){
    const months = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    const days = new Array("Sun","Mon","Tue","Wed", "Thu", "Fri", "Sat");
    var dateObj = new Date();
    var strDate = months[dateObj.getMonth()] + " " +dateObj.getDate() + "-" + days[dateObj.getDay()];
    return strDate;

}

/*function setContent(){
    //Create breakfast block
    var contentHTML=`<p><h2><b>Breakfast</b>
    <table class="foodList bfastTable"></table>
    <button class="addNew" onclick="newFood = new Food('bfast'); today.add(newFood,'bfast'); ">Add New</button></p></h2><br>`;
    document.getElementById("bfast").innerHTML =  contentHTML;//today.redraw("bfast");

    //Create lunch block
    contentHTML=`<p><h2><b>Lunch</b><br>
    <table class="foodList lunchTable"></table>
    <button class="addNew" onclick="newFood = new Food('lunch'); today.add(newFood,'lunch');">Add New</button></p></h2><br>`;
    document.getElementById("lunch").innerHTML =  contentHTML;//today.redraw("lunch");

    //Create dinner block
    contentHTML=`<p><h2><b>Dinner</b><br>
    <table class="foodList dinnerTable"></table>
    <button class="addNew" onclick="newFood = new Food('dinner'); today.add(newFood,'dinner');">Add New</button></p></h2><br>`;
    document.getElementById("dinner").innerHTML =  contentHTML;//today.redraw("dinner");

    //Create extras block
    contentHTML=`<p><h2><b>Extras</b><br>
    <table class="foodList extrasTable"></table>
    <button class="addNew" onclick="newFood = new Food('extras'); today.add(newFood,'extras');">Add New</button></p></h2><br>`;
    document.getElementById("extras").innerHTML =  contentHTML;//today.redraw("extras");



}*/

//Draw header section with textual date
function setupBody(){

    var titleTxt = date2Text() + ` - Gulp`;
    document.title = titleTxt;
    document.getElementById("pghead").innerHTML = `<b>${titleTxt}</b>`;
    //document.getElementById("dateBox").innerHTML = //date2Text();
    //dateBox.innerText = date2Text();

    //setContent();

}
