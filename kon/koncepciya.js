function txtLength(id, id2){
	var txt = document.getElementById(id).value;
	len = txt.length;
	document.getElementById(id2).innerHTML = "Количество символов в тексте = "+len;
}