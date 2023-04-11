let Itemselected = document.getElementById('Itemselected');

Itemselected.addEventListener("change", function(){ 
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	alert(price + " "+ item);
});