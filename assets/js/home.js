$(document).ready(function (){
    var emailUser = localStorage.getItem("username"); //TODO get the response back to retrieve the username instead of email
    emailUser.toUpperCase();
    $('#userHome').html(emailUser.toUpperCase());

    

});