function previewImage(event){

let reader = new FileReader();

reader.onload = function(){

let preview = document.getElementById("preview");
preview.src = reader.result;

}

reader.readAsDataURL(event.target.files[0]);

}


function predictDisease(){

let symptom = document.getElementById("symptom").value;
let result = document.getElementById("result");

result.innerHTML="Analyzing leaf image...";

setTimeout(function(){

if(symptom=="yellow"){

result.innerHTML="Detected: Leaf Blight <br> Treatment: Spray Mancozeb fungicide";

}

else if(symptom=="white"){

result.innerHTML="Detected: Powdery Mildew <br> Treatment: Sulfur Spray";

}

else if(symptom=="holes"){

result.innerHTML="Detected: Insect Attack <br> Treatment: Neem Oil Spray";

}

else if(symptom=="brown"){

result.innerHTML="Detected: Bacterial Spot <br> Treatment: Copper Fungicide";

}

else{

result.innerHTML="Please select symptom";

}

},2000);

}