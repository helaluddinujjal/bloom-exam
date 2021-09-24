$(document).ready(function(){
	//add input attribute field
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

    var fieldHTML = '<div class="mt-2 mb-2 .child-class"> <input type="text" name="ans[]" placeholder="Choice  Answer" class="form-control"/><a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
})