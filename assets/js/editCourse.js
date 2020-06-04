$(document).ready(function(){
    console.log('edit course...');
    
    //only teacher can modify course
    if(localStorage.getItem("isTeacher")){
        var data = JSON.parse(localStorage.getItem("data"));
        const keys = Object.keys(data);
        
        //add selection option with default value

        // keys.forEach((k, index) => {
        //    console.log("keys : ", k , "- index :", index);
        // });


        $.post("/ajax.php", {"byRole" : "1"}, function(){

        })
        .done(function (rsp){
            console.log(JSON.parse(rsp));
            var rsp = JSON.parse(rsp);
            for(var i=0; i<rsp.length;++i){
                if(rsp[i].$lastname == ) //TODO selected ...
                $('#teacher').append("<option>" + rsp[i].$lastname + "</option>");                  //can do better ... :(
            }


        })
        .fail(function (err){
            console.log('boom ...');

        });

        console.log(keys);
        console.log(data);
        $('#' + keys[2]).val(data['courseName']);
        $('#' + keys[3]).val(data['beginAt']);
        $('#' + keys[4]).val(data['description']);
        

    }

});