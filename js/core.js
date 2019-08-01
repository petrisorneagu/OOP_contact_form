function templateObject() {

    "use strict";

    var _formIdentity = '#formContact';
    var _formUrl = 'mod/submit.php';


    function _wrapValidation(message) {

        "use strict";

        return '<span class="warning">' + message + '</span>';

    }


    function _validation(validation) {

        "use strict";

        $.each(validation, function(k, v) {

            $('#' + k).before(_wrapValidation(v));

        });

    }

    /**
     * displays the message in case the form has/n't been succesfully submited
     * @param message
     * @private
     */
    function _displayMessage(thisForm,message){
        "use strict";

        thisForm.find('legend').after(message);

    }

    /**
     *clears the error messagesfrom above each field
     * @param thisForm
     * @private
     */
    function _clearFormValidation(thisForm){
        "use strict";

        thisForm.find('.warning, .alert-box').remove();

    }


    function _resetFoundationCustomSelect(thisForm) {

        "use strict";

        $.each(thisForm.find('.custom.dropdown'), function() {

            $(this).find('ul li').removeClass('selected');
            $(this).find('a.current').html($(this).find('ul li:first-child').text());

        });

    }


    function _reset(thisForm) {

        "use strict";

        thisForm[0].reset();

        _resetFoundationCustomSelect(thisForm);

    }


    function _submitForm() {

        "use strict";

        $(document).on('submit', _formIdentity, function(e) {

            e.preventDefault();
            e.stopPropagation();

            var thisForm = $(this); // #formContact
            var thisArray = thisForm.serializeArray(); // get all fields & values from the form

            $.post(_formUrl, thisArray, function(data) {

                if (data) {

                    if (!data.error) {

                        _clearFormValidation(thisForm);
                        _displayMessage(thisForm, data.message);
                        _resetForm(thisForm);

                    } else if (data.validation) {

                        _clearFormValidation(thisForm);
                        _displayMessage(thisForm, data.message);
                        _validation(data.validation);

                    }

                }

            }, 'json');

        });

    }



    this.init = function() {

        "use strict";

        $(document).foundation(function() {

            _submitForm();

        });

    }

}

$(function() {

    var templateObj = new templateObject();
    templateObj.init();

});
