
    // $('#mytabs li:last-child').on('click', function() {
    //     $('#courses').css("display", "inherit");
    //   // $('#courses').css("position", "0px");
    // });
    


    function showErrorUsuario(){
        successLogin();
        
        
        funcionTimer = setTimeout(function (){
                $("#info-errors").css({
         'height' : 'auto',
        'padding' : '0px 20px 0px 20px'
         });
             
        
         $("#ayudaUsuario").css(
             'background-color',
             'white'
             );
             
        $(".parrafoerror").css(
            {
            'color' : '#0CBDAA',
            'font-size' : '14px',
            'font-weight' : '600',
            'padding-top' : '20px',
            'padding-bottom' : '0px',
            'margin' : '0px 20px 0px 0px'
             }
            );
            
        $(".parrafoerror2").css(
            {
            'padding-bottom' : '0px',
             }
            );    
            
         $("#info-errors").addClass("animated flipInX");  
            }, 500);
        
        
    }


    function showErrorContrasenia(){
        successLogin();
        
        funcionTimer = setTimeout(function (){
         $("#info-errors").css({
         'height' : 'auto',
        'padding' : '0px 20px 0px 20px'
         });
        
        
        $("#ayudaContrasenia").css(
             'background-color',
             'white'
        );
             
        $(".parrafoerror2").css(
            {
            'color' : '#0CBDAA',
            'font-size' : '14px',
            'font-weight' : '600',
            'padding-top' : '0px',
            'padding-bottom' : '20px',
            'margin' : '0px 20px 0px 0px'
             }
            );  
             
        $("#info-errors").addClass("animated flipInX"); 
            }, 500);
    
    }


function successLogin(){
    $("#info-errors").css({
         'height' : '0px',
        'padding' : '0px 0px 0px 0px'
         });

    $("#ayudaUsuario").css(
         'background-color',
         'transparent'
    );
         
    $(".parrafoerror").css(
        {
        'color' : 'transparent',
        'font-size' : '0px',
        'padding-top' : '0px',
        'margin' : '0px'
         }
        );
        
    $(".parrafoerror2").css(
        {
        'color' : 'transparent',
        'font-size' : '0px',
        'padding-top' : '0px',
        'margin' : '0px'
         }
        );
        
    $("#ayudaContrasenia").css(
         'background-color',
         'transparent'
        
        );
        
        $("#info-errors").removeClass("animated flipInX");
         
}