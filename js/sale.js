let itemselected = document.getElementById('Itemselected');
let newselectitem = document.getElementById('newselectitem');
let newselectprice = document.getElementById('newselectprice');
let itemcounter = document.getElementById('itemcounter');

itemselected.addEventListener("change", function(){ 
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	newselectitem.innerHTML=  "Item. " +item;
	newselectprice.innerHTML= "Ksh. " +price;
	itemcounter.innerHTML = ""+1;


});



itemcounter.addEventListener("input", updateValue);

function updateValue(e) {
	var price = Itemselected.options[Itemselected.selectedIndex].value;
	var count = e.target.value;
	totalamount = +count * +price;
	newselectprice.innerHTML= "Ksh. " +totalamount;
}

