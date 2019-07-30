function templateObject(){
    "use strict";
    var _formIdentity = '#formContact';
    var _formUrl = 'mod/submit.php';

    function _submitForm(){
        "use strict";
        $(document).on('submit', _formIdentity, function(e){
            e.preventDefault();
            e.stopPropagation();

            var thisForm = $(this); // #formContact
            var thisArray = thisForm.serializeArray(); // get all fields & values from the form

            // send the form with ajax
            $.post(_formUrl, thisArray, function(data){

                if(data){
                    if(!data.error){
                        _clearFormValidation(thisForm);
                        _displayMessage(thisForm, data.message);
                        _resetForm(thisForm);

                    }else if(data.validation){
                        _clearFormValidation(thisForm);
                        _displayMessage(thisForm, data.message);
                        _validation(data.validation);

                    }

                }

            },'json');

        });
    }

    this.init  = function() {

        "use strict";


        $(document).foundation(function() {
            _submitForm();
        });


    }
}
// document ready
$(function(){
    var templateObj = new templateObject();
    templateObj.init();

});
