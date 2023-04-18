let itemselected = document.getElementById('Itemselected');
let newselectitem = document.getElementById('newselectitem');
let newselectprice = document.getElementById('newselectprice');
let itemcounter = document.getElementById('itemcounter');
let btnaddtorecipt = document.getElementById('btnaddtorecipt');
let snolabel = document.getElementById('snolabel');
let priceholder = document.getElementById('priceholder');
let tblpriceholder = document.getElementById('tblpriceholder');
let tblgrandpriceholder = document.getElementById('tblgrandpriceholder');
var count;
var totalamount;
var grandamount = 0;


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
	if (totalamount >= 1) {
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


  // Add values to the cells
  cell3.innerHTML = totalamount;
  cell2.innerHTML = count;
  cell1.innerHTML = item;
  cell4.innerHTML = `<button class="remove-btn" onclick="removeRow(this)">X</button>`;
  grandamount = +grandamount + +totalamount;
  priceholder.innerHTML = grandamount;
  tblpriceholder.innerHTML = grandamount;
  tblgrandpriceholder.innerHTML = grandamount;

}else{
	alert("Select new item to add ");
}
  
})

// delete item
function removeRow(button) {
			var row = button.parentNode.parentNode;
			row.parentNode.removeChild(row);
		}


// print reciept

printer = document.getElementById('printer');
printer.addEventListener('click', () =>{
	var divToPrint = document.getElementById("readyreciept").innerHTML;
			var newWin = window.open('', 'Print-Window');
			newWin.document.open();
			newWin.document.write('<html><body onload="window.print()">' + divToPrint + '</body></html>');
			newWin.document.close();
			setTimeout(function(){newWin.close();},10);

})

