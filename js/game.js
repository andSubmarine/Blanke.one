window.addEventListener("keypress", checkKeyPressed, false);

var id = 0;
onLoadUp();

function onLoadUp() {
	addTxtToOutput("Welcome to the game of Pirate Hunter!");
}

function checkKeyPressed(e) {
    if (e.keyCode == "13") {
        //alert("The 'enter' key is pressed.");
		checkInput();
		//alert("Input has been checked.");
    } else {
		//alert("A key with the keycode " + e.keyCode + " has been pressed");
	}
}

function checkInput() {
	var inputTxt = document.getElementById("txt").value;
	var emptyTest = isEmpty(inputTxt);
	if (!emptyTest){
		addTxtToOutput(inputTxt);
		//alert("FOCUS");
		//focusOnElement();
		//alert("CLEAR");
		//$('#output'+id).scrollspy({ target: '#navbar-example' }); from bootstrap...
		clearInput();
	} else {
		//alert("ALERT: The text is empty: "+emptyTest);
	}
}

function focusOnElement() {
	for (var i = 1; i < id - 1; i++) {
		var output_id = "#output"+i;
		//alert(output_id);
		var query = document.querySelector(output_id);
		//alert(query);
		query.autofocus = false;
	}
	var output_id = "#output"+(id - 1);
	//alert(output_id);
	var query = document.querySelector(output_id);
	//alert(query);
	document.querySelector("txt").autofocus = false;
	query.autofocus = true;
	document.querySelector("txt").autofocus = true;
}

function clearInput() {
	var txt = document.getElementById("txt");
	txt.value = '';
}

function addTxtToOutput(txt){
	var para = document.createElement("p");
	var node = document.createTextNode(" -> " + txt);
	para.appendChild(node);
	para.setAttribute('class','output');
	para.setAttribute('id','output'+id);
	id++;
	var e = document.getElementById("output");
	e.appendChild(para);
}

function isEmpty(str) {
    return (!str || 0 == str.length);
}

