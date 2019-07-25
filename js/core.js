function templateObject(){
    "use strict";
    var formIdentity = '#formContact';
    var formUrl = 'mod/submit.php';

    this.init  = function() {
        "use strict";

        function _submitForm(){
            "use strict";
        }


        $(document).foundation(function(){

            _submitForm();
        });


    }
}
// document ready
$(function(){
    var templateObj = new templateObject();
    templateObj.init();

});

