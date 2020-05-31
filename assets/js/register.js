$(document).ready(function () {
    console.log("ready to register");

    $('#submitRegister').on('submit', function(e){
        e.preventDefault();
        //console.log("cliecked on submit");

        data = {
            'pk_id'     : -1,
            'lastname'  : $('#lastnameField').val(),
            'firstname' : $('#firstnameField').val(),
            'email'     : $('#emailField').val(),
            'password'  : $('#passwordField').val(),
            'fk_role'   : $('input[name=fk_role]:checked').val()
        }

        //TODO check if the user is already exist 
        //redirect user to login page...
        console.log(data);


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


           