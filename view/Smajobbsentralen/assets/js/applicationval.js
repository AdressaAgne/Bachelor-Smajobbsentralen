$(function(){
    
    function removeError(){
            $(this).next('span').css('visibility', "hidden");
            $(this).css('box-shadow', "");
            $(this).css('borderColor', "");
        };
    
    $("[name=firstname]").on('click', removeError );
    $("[name=lastname]").on('click', removeError );
    $("[name=email]").on('click', removeError );
    $("[name=address]").on('click', removeError );
    $("[name=date]").on('click', removeError );
    $("[name=mob]").on('click', removeError );
    
$("form").submit(function (e) {
    e.preventDefault();
    
    var numbersCheck = /[0-9]/;
    var characterCheck = /^[a-zA-Z-_ æøåÆØÅ]+$/
    var emailCheck = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    function validateAll(inputfield, errormsg1, errormsg2){
        
    }
    
    function validateFName() {
        
        ffn = $("[name=firstname]");
        emfn = ffn.next('span');
        fName = ffn.val();
        
        if (fName == "") {
            emfn.css('visibility', "visible");
            emfn.html("Fornavn kan ikke være tomt");
            ffn.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            ffn.css('borderColor', "#d40000");
            return false;
        } else if (!fName.match(characterCheck)) {
            emfn.css('visibility', "visible");
            emfn.html("Dette navnet er ugyldig");
            ffn.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            ffn.css('borderColor', "#d40000");
            return false;
        } 
    }
    
    function validateLName() {
        
        fln = $("[name=lastname]");
        emln = fln.next('span');
        lName = fln.val();

        if (lName == "") {
            emln.css('visibility', "visible");
            emln.html("Etternavn kan ikke være tomt");
            fln.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fln.css('borderColor', "#d40000");
            return false;
        } else if (!lName.match(characterCheck)) {
            emln.css('visibility', "visible");
            emln.html("Dette navnet er ugyldig");
            fln.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fln.css('borderColor', "#d40000");
            return false;
        }
    }
    
    function validateEmail() {
        
        fe = $("[name=email]");
        eme = fe.next('span');
        email = fe.val();

        if (email == "") {
            eme.css('visibility', "visible");
            eme.html("E-post kan ikke være tomt");
            fe.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fe.css('borderColor', "#d40000");
            return false;
        } else if (!email.match(emailCheck)) {
            eme.css('visibility', "visible");
            eme.html("Epostadressen er ugyldig");
            fe.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fe.css('borderColor', "#d40000");
            return false;
        } 
    }
    
    function validateAddress() {
        
        fa = $("[name=address]");
        ema = fa.next('span');
        address = fa.val();
        

        if (address == "") {
            ema.css('visibility', "visible");
            ema.html("Adresse kan ikke være tomt");
            fa.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fa.css('borderColor', "#d40000");
            return false;
        }
    }
    
    function validateDate() {
        
        fd = $("[name=date]");
        emd = fd.next('span');
        date = fd.val();

        if (date == "") {
            emd.css('visibility', "visible");
            emd.html("Fødselsdato kan ikke være tomt");
            fd.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fd.css('borderColor', "#d40000");
            return false;
        }
    }
    
    function validateMob() {
        
        fm = $("[name=mob]");
        emm = fm.next('span');
        mob = fm.val();
        

        if (mob == "") {
            emm.css('visibility', "visible");
            emm.html("Mobilnummer kan ikke være tomt");
            fm.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fm.css('borderColor', "#d40000");
            return false;
        } else if (!mob.match(numbersCheck)) {
            emm.css('visibility', "visible");
            emm.html("Nummeret er ugyldig");
            fm.css('box-shadow', "inset 100vw 0px 0px 0px #bd0000");
            fm.css('borderColor', "#d40000");
            return false;
        } 
    }
    
    function validateCar(){
        emc = $("#errorMsgCar");
        
        if ($('#hascar input[type=radio]:checked').length == 0) {
            emc.css('visibility', "visible");
            emc.html("Du må svare");
            return false;
        } else {
            emc.css('visibility', "hidden");
        }
    }
    
    function validateHitch(){
        emc = $("#errorMsgHitch");
        
        if ($('#hashitch input[type=radio]:checked').length == 0) {
            emc.css('visibility', "visible");
            emc.html("Du må svare");
            return false;
        } else {
            emc.css('visibility', "hidden");
        }
    }
    
    function validateOcc(){
        emc = $("#errorMsgOcc");
        
        if ($('#hasocc input[type=radio]:checked').length == 0) {
            emc.css('visibility', "visible");
            emc.html("Du må svare");
            return false;
        } else {
            emc.css('visibility', "hidden");
        }
    }
    
    function validateCheck() {
    
        emc = $("#errorMsgCheck");
        
        if ($('#categories input[type=checkbox]:checked').length == 0) {
            emc.css('visibility', "visible");
            emc.html("Du må velge minimum ett arbeidsområde");
            return false;
        } else {
            emc.css('visibility', "hidden");
        }
    };
    
    function validateConf() {
    
        emc = $("#errorMsgConf");
        
        if ($('#conf input[type=checkbox]:checked').length == 0) {
            emc.css('visibility', "visible");
            emc.html("Du må godkjenne taushetserklæringen");
            return false;
        } else {
            emc.css('visibility', "hidden");
        }
    };


    if (validateFName() & validateLName() & validateEmail() & validateAddress() & validateDate() & validateMob() & validateCar() & validateHitch() & validateOcc() & validateCheck() & validateConf() == false) {
        e.preventDefault();
    }

});

});