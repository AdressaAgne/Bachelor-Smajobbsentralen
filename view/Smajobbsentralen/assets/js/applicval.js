/*

This code is never used, to be continued

*/

$(function(){
    var inputTypes;
    $("form").submit(function (e) {  
        e.preventDefault();
        
        var input = $('input:not([name^=_])');
        
        $('input:not([name^=_]').each(function(){
            inputTypes = $(this).attr('name');
            
            switch(inputTypes) {
                case 'firstname' :
                    if (checkIfBlanc('firstname', "Fornavn kan ikke være tomt") == true) {
                        break;
                    } else if (checkIfMatch('firstname', "Dette navnet er ugyldig", '/^[a-zA-Z-_ æøåÆØÅ]+$/') == true){
                        break;
                    }
                }
        });
        
        function checkIfBlanc(name, errorMsg){
            inputElement = $("[name=" + name + "]");
                        
            if (inputElement.val() == "") {
                inputElement.next('span').css('visibility', "visible");
                inputElement.next('span').html(errorMsg);
                inputElement.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
                inputElement.css('borderColor', "#d40000");
                return true;   
            }
        }
            
        function checkIfMatch(name, errorMsg, regexMatch){
            inputElement = $("[name=" + name + "]");
            
            if (!inputElement.val().match(regexMatch)) {
                inputElement.next('span').css('visibility', "visible");
                inputElement.next('span').html(errorMsg);
                inputElement.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
                inputElement.css('borderColor', "#d40000");
                return true;
            } 
        } 
 });

});