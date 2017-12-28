function superImage(img){
	if(document.getElementById("overlay").style.display == "none"){
		document.getElementById("superimg").src = img; 
		console.log("clicked");
		document.getElementById("overlay").style.display = "block";
	}
	else{
		document.getElementById("overlay").style.display = "none";
	}
}