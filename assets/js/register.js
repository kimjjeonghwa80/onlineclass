$(document).ready(function () {
    //console.log("ready to register");

    $('#submitRegister').on('submit', function(e){
        e.preventDefault();
        //console.log("cliecked on submit");

        var fkRole = $('input[name=fk_role]:checked').val();
        fkRole = fkRole.substring(0, fkRole.length -1);
        console.log(fkRole);

        data = {
            'pk_id'         : -1,
            'lastname'      : $('#lastnameField').val(),
            'firstname'     : $('#firstnameField').val(),
            'email'         : $('#emailField').val(),
            'password'      : $('#passwordField').val(),
            'fk_role'       : fkRole,
            'session_token' : 0,
            'session_time'  : 0
        }


        //TODO check if the user is already exist 
        //redirect user to login page...
        //do email.lowerCase() to preserve uniq stuff


        var xhr = $.post('/ajax.php', data, function(){
                //console.log("send post");
            
        })
        .done(function(){
            console.log('do something ...');
            window.location.href = "/login.php";
        })
        .fail(function(err){
            console.log(err);
        });

        console.log(xhr);

    });


}); 


           