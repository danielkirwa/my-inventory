let itemselected = document.getElementById('Itemselected');
let newselectitem = document.getElementById('newselectitem');
let newselectprice = document.getElementById('newselectprice');
let itemcounter = document.getElementById('itemcounter');
let btnaddtorecipt = document.getElementById('btnaddtorecipt');
let snolabel = document.getElementById('snolabel');
var count;
var totalamount;


itemselected.addEventListener("change", function(){ 
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	newselectitem.innerHTML=  "Item. " +item;
	newselectprice.innerHTML= "Ksh. " +price;
	count = 1;
	totalamount = price;

});



itemcounter.addEventListener("input", updateValue);

function updateValue(e) {
	var price = Itemselected.options[Itemselected.selectedIndex].value;
	 count = e.target.value;
	if (count < 1) {
     itemcounter.value = 1;
	}else{
    totalamount = +count * +price;
	newselectprice.innerHTML= "Ksh. " +totalamount;
	}
	
}

btnaddtorecipt.addEventListener('click', () =>{
	itemcounter.value = 1;
	newselectitem.innerHTML=  "Item. ";
	newselectprice.innerHTML= "Ksh. ";
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	  // Get the table
  var table = document.getElementById("reciepttable");

  // Create a new row
  var row = table.insertRow(-1);

  // Insert new cells
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);



  // Add values to the cells
  cell1.innerHTML = "";
  cell3.innerHTML = totalamount;
  cell4.innerHTML = count;
  cell2.innerHTML = item;
  cell5.innerHTML = "item";


  
})
