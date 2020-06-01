$(document).ready(function (){
    console.log("login page");
    $('.submitLoginForm').on('submit', function (e){
        e.preventDefault();
        //console.log("try to login...");

        var email   = $('#iEmail').val();
        var pswd    = $('#iPassword').val();

        data = {
            'login'     : email,
            'password'  : pswd
        };

        console.log(data);

        var xhr = $.post('/ajax.php', data, function(){
            console.log("send post login ...");
        })
        .done(function(data){
            console.log('Your are login with name :', data.login);
            console.log('success !');
            
            //window.location.href = '/home.php';
            
        })
        .fail(function(data){
            console.log(data.responseText);
        });

        //console.log(xhr);


    });
});