$(document).ready(function () {
    console.log("ready to register");

    $('#submitRegister').on('submit', function(e){
        e.preventDefault();
        console.log("cliecked on submit");

        data = {
            'pk_id'     : -1,
            'lastname'  : $('#lastnameField').val(),
            'firstname' : $('#firstnameField').val(),
            'email'     : $('#emailField').val(),
            'password'  : $('#passwordField').val(),
            'fk_role'   : 1                           //$('input[name=radioName]:checked').val()
        }
        var xhr = $.post('/ajax.php', data, function(){
                console.log("send post");
            }
        );

        console.log(xhr);

    });


}); 


           