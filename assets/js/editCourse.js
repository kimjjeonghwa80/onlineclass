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
                if(rsp[i].lastname){ //TODO selected option on previous page ...
                    $('#teacher').append("<option>" + rsp[i].lastname + "</option>");                  
                } 
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

        $.get("/ajax.php?allModules", function(){

        })
        .done(function (rsp){
            var rsp = JSON.parse(rsp);
            for(var i=0; i<rsp.length;++i){
                if(rsp[i].name){ //TODO selected option on previous page ...
                    $('#module').append("<option>" + rsp[i].name + "</option>");                  
                } 
            }
        })
        .fail(function (err){

        });


        /** submit update */
    
        $('#submitRegisterCourse').on('submit', function(e){
            e.preventDefault();

            //console.log("try sumbit");
            var courseName = $('#courseName').val();
            var beginAt = $('#beginAt').val();
            var description = $('#description').val();
            var fk_teacher = $('#teacher').val();
            var module = $('#module').val();

            var data = {courseName,courseName,description,beginAt,fk_teacher,fk_module};
            console.log(data);
        });
        
    }

});