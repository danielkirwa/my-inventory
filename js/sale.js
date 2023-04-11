let Itemselected = document.getElementById('Itemselected');
let newselectitem = document.getElementById('newselectitem');
let newselectprice = document.getElementById('newselectprice');

Itemselected.addEventListener("change", function(){ 
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	newselectitem.innerHTML=  "Item. " +item;
	newselectprice.innerHTML= "Ksh. " +price;


});