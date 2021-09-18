function Food(time) {

  this.time = time;
  this.name = prompt("Name:");
  this.amount = prompt("Amount:");

}

function dayList(theDay) {
        //Create lists for different times
        this.bfast = new Array();
        this.lunch = new Array();
        this.dinner = new Array();
        this.extras = new Array();
        this.suggest = new Array();
        this.currList = new Array();
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
function date2Text(numDate){
    /*const months = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    const days = new Array("Sun","Mon","Tue","Wed", "Thu", "Fri", "Sat");*/
    if (numDate!=null){
        dateStr = numDate.split("-");
        theYear = dateStr[0];
        if (dateStr[1].startsWith("0")) {theMonth = dateStr[1].substr(1,1);} else {theMonth=dateStr[1];}
        if (dateStr[2].startsWith("0")) {theDay = dateStr[2].substr(1,1);} else {theDay=dateStr[2];}
        dateObj = new Date(theYear,theMonth-1,theDay);
    
    }
    else {dateObj = new Date();  }
    //var strDate = months[dateObj.getMonth()] + " " +dateObj.getDate() + "-" + days[dateObj.getDay()];
    return dateObj.toDateString();

}



//Draw header section with textual date
function setupBody(theDate){

    theDate=date2Text(theDate);
    titleTxt = theDate + ` - CRUDGulp`;
    document.title = titleTxt;
    document.getElementById("pghead").innerHTML = `<b>${titleTxt}</b>`;
    //loadNutrition();
    
}

function loadNutrition(){
  nutri = new asyncObj("sqlpdo.php","q=looad","POST","nutrilist");
}
