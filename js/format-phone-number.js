var focus = false;
var canEdit = false;

$(document).ready(function(){
	var inputs = $(".phone-input");

	inputs.each(function(index, item) {
    var input = $(item);

		input.focusin(function(){
			if(input.val() == "")
				focus = false;
			if(!focus){
				addNumbers(input);
				focus = true;
			}
		});
		input.on("keyup", function(event){
			if(input.val().length == 0){
				text = input.val();
				input.val("+38(0" + text);
			}
			if(event.keyCode == 8)
				canEdit = true;
			else
				canEdit = false;
			if(!canEdit)
				checkInput(input);
		});
	});
});

function addNumbers(input){
	input.val("+38(0");
}

function checkInput(input){
	if(input.val().length == 7)
		input.val(input.val() + ")-");
	if(input.val().length == 12 || input.val().length == 15)
		input.val(input.val() + "-");
}
