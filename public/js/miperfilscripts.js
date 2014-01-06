
$(document).ready(function(){
    var path = window.location.pathname.split('/');
    var basePath = '';
    for(var i = 1; i < path.length; i++){
        basePath += '/'+path[i];
        if(path[i] === 'public'){
            i = path.length;
        }
    }
    
    getMunicipiosReceptor();
   
    getMunicipiosEnvio();
    
    // cargar las poblaciones al cambiar de estado
    $('#receptor_estado').change(function(){
       getMunicipiosReceptor();
    });
    
    $('#envio_estado').change(function(){
        getMunicipiosEnvio();
    });
    
    $('#password_new').keyup(function() {
        $('#result').html(checkStrength($('#password_new').val()));
    });
     
    $('#form-2').submit(function() {
        
        var path = window.location.pathname.split('/');
        var basePath = '';
        for(var i = 1; i < path.length; i++){
            basePath += '/'+path[i];
            if(path[i] === 'public'){
                i = path.length;
            }
        }

        var is_pass_valid;
        $.ajax({
            type: "POST",
            async: false, 
            url: basePath+"/usuarios/verifypassword",
            data: { password_actual: $('#password_actual').val()},
            success: function(response){
                is_pass_valid = response;  
             }
        });
                      
        if(!is_pass_valid){
            showErrorMessage1('La constraseña actual no es válida');
            alert('La contraseña actual no es válida');
            return false;
        }
        
        
        if (!validatePart1()) {
            return false;
        }

        if (!validatePart2()) {
            return false;
        }

        if (!validatePart3()) {
            return false;
        }
        
    });
    
    // -------------------- validacion de campos en tiempo real --------------------
    // -----------------------------------------------------------------------------

    $('#username').change( function(){
        if(!is_alphanumeric($('#username').val()) ){
            $('#error_username').html('Su nombre de usuario no debe incluir caracteres especiales');
        }else{
            $('#error_username').html('');
        }
    });

    $('#email').change(function(){
        if(!emailIsValid($('#email').val())){
            $('#error_email').html('El email no es válido');
        }else{
            $('#error_email').html('');
        }
    });

    $('#display_name').change(function(){
        if(!is_only_letters($('#display_name').val())){
            $('#error_display_name').html('El nombre sólo debe contener letras');
        }else{
            $('#error_display_name').html('');
        }
    });

    $('#receptor_rfc').change(function(){
        if(!is_rfc_valid($('#receptor_rfc').val())){
            $('#error_receptor_rfc').html('El RFC no es válido');
        }else{
            $('#error_receptor_rfc').html('');
        }
    });

    $('#receptor_nombre').change(function(){
        if(!is_only_letters($('#receptor_nombre').val())){
            $('#error_receptor_nombre').html('El nombre sólo debe contener letras');
        }else{
            $('#error_receptor_nombre').html('');
        }
    });

    $('#receptor_calle').change(function(){
        if(!is_alphanumeric($('#receptor_calle').val())){
            $('#error_receptor_calle').html('No se aceptan caracteres especiales');
        }else{
            $('#error_receptor_calle').html('');
        }
    });

    $('#receptor_noexterior').change(function(){
        if(!is_numeric($('#receptor_noexterior').val())){
            $('#error_receptor_noexterior').html('Sólo se aceptan números');
        }else{
            $('#error_receptor_noexterior').html('');
        }
    });

    $('#receptor_nointerior').change(function(){
        if(!is_alphanumeric($('#receptor_nointerior').val())){
            $('#error_receptor_nointerior').html('No debe contener caracteres especiales');
        }else{
            $('#error_receptor_nointerior').html('');
        }
    });

    $('#receptor_codigopostal').change(function(){
        if(!is_numeric($('#receptor_codigopostal').val())){
            $('#error_receptor_codigopostal').html('Sólo se aceptan números');
        }else{
            $('#error_receptor_codigopostal').html('');
        }
    });

    $('#receptor_colonia').change(function(){
        if(!is_alphanumeric($('#receptor_colonia').val())){
            $('#error_receptor_colonia').html('No debe contener caracteres especiales');
        }else{
            $('#error_receptor_colonia').html('');
        }
    });

    $('#envio_contacto').change(function(){
        if(!is_only_letters($('#envio_contacto').val())){
            $('#error_envio_contacto').html('El nombre de contacto no es válido');
        }else{
            $('#error_envio_contacto').html('');
        }
    });

    $('#envio_calle').change(function(){
        if(!is_alphanumeric($('#envio_calle').val())){
            $('#error_envio_calle').html('No debe contener carcateres especiales');
        }else{
            $('#error_envio_calle').html('');
        }
    });

    $('#envio_noexterior').change(function(){
        if(!is_numeric($('#envio_noexterior').val())){
            $('#error_envio_noexterior').html('Sólo se aceptan números');
        }else{
            $('#error_envio_noexterior').html('');
        }   
    });

    $('#envio_nointerior').change(function(){
        if(!is_alphanumeric($('#envio_nointerior').val())){
            $('#error_envio_nointerior').html('No debe contener carcateres especiales');
        }else{
            $('#error_envio_nointerior').html('');
        }
    });

    $('#envio_codigopostal').change(function(){
        if(!is_numeric($('#envio_codigopostal').val())){
            $('#error_envio_codigopostal').html('Sólo se aceptan números');
        }else{
            $('#error_envio_codigopostal').html('');
        }
    });

    $('#envio_colonia').change(function(){
        if(!is_alphanumeric($('#envio_colonia').val())){
            $('#error_envio_colonia').html('No se aceptan caracteres especiales');
        }else{
            $('#error_envio_colonia').html('');
        }
    });

    $('#envio_crucecalles').change(function(){
        if(!is_alphanumeric($('#envio_crucecalles').val())){
            $('#error_envio_crucecalles').html('No se aceptan caracteres especiales');
        }else{
            $('#error_envio_crucecalles').html();
        }   
    });

    $('#envio_telefono').change(function(){
        if(!is_numeric($('#envio_telefono').val())){
            $('#error_envio_telefono').html('El teléfono debe contener sólo números');
        }else{  
            $('#error_envio_telefono').html('');
        }
    });
});

function is_numeric(value){
    var TCode = value
    if( /[^0-9]/.test( TCode ) ) {
       return false;
    }
    return true;     
}

function is_only_letters(value){
    var TCode = value
    if( /[^a-zA-Z_-]/.test( TCode ) ) {
       return false;
    }
    return true;     
}

function is_alphanumeric(value){
    var TCode = value
    if( /[^a-zA-Z0-9]/.test( TCode ) ) {
       return false;
    }
    return true;     
}


function emailIsValid(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    if (pattern.test(email)) {
        return true;
    } else {
        return false;
    }
}


function is_rfc_valid(rfcStr) {
    var strCorrecta;
    strCorrecta = rfcStr;
    if (rfcStr.length === 12) {
        var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    } else {
        var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }

    var validRfc = new RegExp(valid);
    var matchArray = strCorrecta.match(validRfc);
    if (matchArray === null) {
        return false;
    } else {
        return true;
    }
}

// obtener los municipios en base al estado
function getMunicipiosReceptor(){
    var basePath = $('#basepath').val();
    var id_estado = $('#receptor_estado').val();
    if(id_estado != ''){
        $.ajax({
            type: "POST",
            async: false, 
            url: basePath+"/usuarios/getpoblaciones/"+id_estado,
            success: function(response){
                var municipios = response;
                var options = [];
                jQuery.each(municipios, function(key, val){
                    // obtener el valor actual
                    var selected = $('#municipio_actual_receptor').val();
                    if(selected == val['id']){
                        options.push('<option value='+val['id']+' selected="selected">'+val['nombre']+'</option>');
                    }else{
                        options.push('<option value='+val['id']+'>'+val['nombre']+'</option>');
                    }
                });
                $('#receptor_municipio').html('<option value="">---Selecciona---</option>');
                $('#receptor_municipio').append(options);
            }
        });
    }
}

// obtener los municipios en base al estado
function getMunicipiosEnvio(){
    var basePath = $('#basepath').val();
    var id_estado = $('#envio_estado').val();
    if(id_estado != ''){
        $.ajax({
            type: "POST",
            //async: false, 
            url: basePath+"/usuarios/getpoblaciones/"+id_estado,
            success: function(response){
                var municipios = response;
                var options = [];
                jQuery.each(municipios, function(key, val){
                    // obtener el valor actual
                    var selected = $('#municipio_actual_envio').val(); 
                    if(selected == val['id']){
                        options.push('<option value='+val['id']+' selected="selected">'+val['nombre']+'</option>');
                    }else{
                        options.push('<option value='+val['id']+'>'+val['nombre']+'</option>');
                    }
                });
                $('#envio_municipio').html('<option value="">---Selecciona---</option>');
                $('#envio_municipio').append(options);
            }
        });
    }
}

function validatePart1(){
    var nombre = $('#username').val();
    var email = $('#email').val();
    var display_name = $('#display_name').val();
    var password = $('#password_new').val();
    var passwordVerify = $('#password_new_verify').val();

    if (nombre === '') {
        showErrorMessage1('El nombre de usuario no puede estar vacío');
        return false;
    }
    
    // validar que el email no esta vacío y es valido
    if(email === '') {
        showErrorMessage1('El email no puede estar vacío');
        return false;
    }else if (!emailIsValid(email)) {
        showErrorMessage1('El email no es valido');
        return false;
    }

    if (display_name === '') {
        showErrorMessage1('El nombre no puede estar vacío');
        return false;
    }

    if (password !== '') {
        if(passwordVerify === ''){
            showErrorMessage1('Por favor, verifique su contraseña');
            return false;
        }else if (password !== passwordVerify) {
            showErrorMessage1('Las constrañas no coinciden');
            return false;
        } 
    }
     
    return true;
}


function validatePart2() {
    var receptor_rfc = $('#receptor_rfc').val();
    var receptor_nombre = $('#receptor_nombre').val();
    var receptor_calle = $('#receptor_calle').val();
    var receptor_noexterior = $('#receptor_noexterior').val();
    //var receptor_nointerior   = $('#receptor_nointerior').val();
    var receptor_codigopostal = $('#receptor_codigopostal').val();
    var receptor_colonia = $('#receptor_colonia').val();
    var receptor_estado = $('#receptor_estado').val();
    var receptor_municipio = $('#receptor_municipio').val();
    var receptor_pais = $('#receptor_pais').val();

    if (!ValidaRfc(receptor_rfc)) {
        showErrorMessage2('El RFC no es válido');
        return false;
    }

    if (receptor_nombre === '') {
        showErrorMessage2('El nombre no puede estar vacío');
        return false;
    }

    if (receptor_calle === '') {
        showErrorMessage2('Ingrese el nombre de su calle');
        return false;
    }

    if (receptor_noexterior === '') {
        showErrorMessage2('Ingrese el número exterior');
        return false;
    }

    if (receptor_codigopostal === '') {
        showErrorMessage2('Ingrese el número de su código postal');
        return false;
    }

    if (receptor_colonia === '') {
        showErrorMessage2('Ingrese el nombre de su colonia');
        return false;
    }

    if (receptor_estado === '') {
        showErrorMessage2('Ingrese el estado donde recide');
        return false;
    }

    if (receptor_municipio === '') {
        showErrorMessage2('Ingrese el municipio donde recide');
        return false;
    }

    if (receptor_pais === '') {
        showErrorMessage2('Ingrese el país donde recide');
        return false;
    }

    return true;
}


function validatePart3() {
    var envio_contacto = $('#envio_contacto').val();
    var envio_calle = $('#envio_calle').val();
    var envio_noexterior = $('#envio_noexterior').val();
    //var envio_nointerior = $('#envio_nointerior').val();
    var envio_codigopostal = $('#envio_codigopostal').val();
    var envio_colonia = $('#envio_colonia').val();
    var envio_estado = $('#envio_estado').val();
    var envio_municipio = $('#envio_municipio').val();
    var envio_crucecalles = $('#envio_crucecalles').val();
    var envio_telefono = $('#envio_telefono').val();

    if (envio_contacto === '') {
        showErrorMessage3('Ingrese el nombre del contacto');
        return false;
    }

    if (envio_calle === '') {
        showErrorMessage3('Ingrese el nombre de la calle');
        return false;
    }

    if (envio_noexterior === '') {
        showErrorMessage3('Ingrese el número exterior');
        return false;
    }

    if (envio_codigopostal === '') {
        showErrorMessage3('Ingrese el código postal');
        return false;
    }

    if (envio_colonia === '') {
        showErrorMessage3('Ingrese la colonia');
        return false;
    }

    if (envio_estado === '') {
        showErrorMessage3('Ingrese el estado');
        return false;
    }

    if (envio_municipio === '') {
        showErrorMessage3('Ingrese el municipio');
        return false;
    }

    if (envio_crucecalles === '') {
        showErrorMessage3('Ingrese el cruce de calles');
        return false;
    }

    if (envio_telefono === '') {
        showErrorMessage3('Ingrese el teléfono');
        return false;
    }

    return true;
}

function showErrorMessage1(message){
    $('#steps-uid-1-t-0').trigger('click');
    $('#errorMessage1').html(message);
}

function showErrorMessage2(message){
    $('#steps-uid-1-t-1').trigger('click');
    $('#errorMessage2').html(message);
}

function showErrorMessage3(message) {
    $('#steps-uid-1-t-2').trigger('click');
    $('#errorMessage3').html(message);
}

function emailIsValid(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    if (pattern.test(email)) {
        return true;
    } else {
        return false;
    }
}

function ValidaRfc(rfcStr) {
    var strCorrecta;
    strCorrecta = rfcStr;
    if (rfcStr.length === 12) {
        var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    } else {
        var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }

    var validRfc = new RegExp(valid);
    var matchArray = strCorrecta.match(validRfc);
    if (matchArray === null) {
        return false;
    } else {
        return true;
    }
}

function checkStrength(password) {

    //initial strength
    var strength = 0;

    //if the password length is less than 6, return message.
    if (password.length < 6) {
        $('#result').removeClass();
        $('#result').addClass('short');
        return 'Too short';
    }

    //length is ok, lets continue.

    //if length is 8 characters or more, increase strength value
    if (password.length > 7)
        strength += 1;

    //if password contains both lower and uppercase characters, increase strength value
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
        strength += 1;

    //if it has numbers and characters, increase strength value
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
        strength += 1;

    //if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
        strength += 1;

    //if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/))
        strength += 1;

    //now we have calculated strength value, we can return messages

    //if value is less than 2
    if (strength < 2) {
        $('#result').removeClass()
        $('#result').addClass('weak');
        return 'Weak';
    } else if (strength === 2) {
        $('#result').removeClass();
        $('#result').addClass('good');
        return 'Good';
    } else {
        $('#result').removeClass();
        $('#result').addClass('strong');
        return 'Strong';
    }
}