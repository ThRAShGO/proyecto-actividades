/*global $*/

$(document).ready(function(){
    
    $('#btLogin').on('click', validar);
    
    function validar(e){
        
        var email_ok = validarEmail($('#usuarioLogin'));
        var pass_ok = validarPassword($('#contraseniaLogin'), 4);
        
        if( !email_ok || !pass_ok){
            e.preventDefault();
        }
    }
    
    // Comprueba que el campo email no este vacio y tenga
    // el formato correcto.
    function validarEmail(nodo){
        
        var email = nodo.val();
        var correcto = true;
        
        nodo.next().next().text('');
        
        if ( email === '' ){
            correcto = false;
            nodo.next().next().text('El campo email no puede estar vacio.');
        } else {
            var expr = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            
            if ( !expr.test( email ) ){
                correcto = false;
                nodo.next().next().text('El formato del email introducido no es correcto.');
            }
        }
        return correcto;
    }
    
    // Comprueba que el campo password no este vacio y tenga
    // el formato correcto.
    function validarPassword(nodo, min){
        
        var pass = nodo.val();
        var correcto = true;
        
        nodo.next().next().text('');
        
        // Comprueba tamaño minimo.
        if ( pass.length < min ){
            correcto = false;
            nodo.next().next().text('Debe contener al menos 4 caracteres');
        } else {
            // Comprueba que contenga letras
            if( !pass.match(/[A-z]/) ){
                correcto = false;
                nodo.next().next().text('Debe contener letras.');
            }
            
            // Comprueba que contenga mayusculas
            if(!pass.match(/[A-Z]/)){
                correcto = false;
                nodo.next().next().text('Debe contener al menos una mayúscula.');
            }
            
            // Comprueba que contenga numeros
            if(!pass.match(/\d/)){
                correcto = false;
                nodo.next().next().text('Debe contener al menos un número.');
            }
        }
        return correcto;
    }
});