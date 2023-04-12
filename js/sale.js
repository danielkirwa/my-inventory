let itemselected = document.getElementById('Itemselected');
let newselectitem = document.getElementById('newselectitem');
let newselectprice = document.getElementById('newselectprice');
let itemcounter = document.getElementById('itemcounter');
let btnaddtorecipt = document.getElementById('btnaddtorecipt');

itemselected.addEventListener("change", function(){ 
var item = Itemselected.options[Itemselected.selectedIndex].text;
var price = Itemselected.options[Itemselected.selectedIndex].value;
	newselectitem.innerHTML=  "Item. " +item;
	newselectprice.innerHTML= "Ksh. " +price;

});



itemcounter.addEventListener("input", updateValue);

function updateValue(e) {
	var price = Itemselected.options[Itemselected.selectedIndex].value;
	var count = e.target.value;
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
})
