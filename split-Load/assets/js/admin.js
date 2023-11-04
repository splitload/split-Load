function updateInput(newvar, inputvar){
    document.getElementById(inputvar).value = newvar;
}

function onoff(checkbox, span) {
    
    var checkboxvar = document.getElementById(checkbox);
    var spanvar = document.getElementById(span);
    if (!checkboxvar.checked) {
        spanvar.innerHTML = "Disabled";
    }
    else {
        spanvar.innerHTML = "Enabled";
    }
}

$(document).ready(function(){
	$("#helpbtn-close").css("display", "none");
	$("#helpbtn").click(function(){
	$("#help-box").stop().animate({margin: "170px 0 0 -200px"});
	$("#helpbtn").css("display", "none");
	$("#helpbtn-close").css("display", "block");
	});
	
	$("#helpbtn-close").click(function(){
	$("#help-box").stop().animate({margin: "0px 0 0 -200px"});
	$("#helpbtn").css("display", "block");
	$("#helpbtn-close").css("display", "none");
	});
});