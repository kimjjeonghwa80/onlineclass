$(document).ready(function (){

    
    var emailUser = localStorage.getItem("username"); //TODO get the response back to retrieve the username instead of email
    emailUser.toUpperCase();

    if(localStorage.getItem("isTeacher")){
        $("h1#role").html("Teacher view");
    }else{
        $("h1#role").html("Student view");              //TODO setup a student view (gestion des droits)
    }
    /**
     * send post request to fetch all courses and display in table
     */
    $('#userHome').html(emailUser.toUpperCase());

    //j'explore une autre manière de faire du xhr...
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var rsp = JSON.parse(this.responseText);
            console.log(rsp);
            if(rsp){
                //console.log(typeof rsp);
                rsp.forEach((element) => { //loop over object not array
                    $('#tableCourses > tbody:last-child').append(
                        '<tr>'
                            +  '<td class="coursesList">TODO</td>'
                            +  '<td class="coursesList">TODO</td>'
                            +  '<td class="coursesList">' + element['courseName']     + '</td>'
                            +  '<td class="coursesList">' + element['beginAt']        + '</td>'
                            +  '<td class="coursesList">' + element['description']    + '</td>'
                            +  '<td><button class="editCourse">Edit</buton></td>' +                             //todo if student dont put edit button
                        + '</tr>'
                  );
                });
                
            }
            
        }
    }
    // send request
    xmlhttp.open("GET", "/ajax.php?allcourses", true);
    xmlhttp.send();

    /**
     * Edit modules/courses
     * 
     */
    $(document).on("click", "#tableCourses tbody tr td button.editCourse", function(){
        var trs = $(this).closest("tr");
        var tds = trs.find("td");
        var arr = [];

    
        $.each(tds, function(){
            // var th = $('#tableCourses th').eq($(this).index());
            // console.log(th);
            arr.push($(this).text()); 
            //console.log(this);
        });
        
        //I'm lazy, can do better
        data = 
        {
            fk_module      : arr[0],
            fk_teacher     : arr[1],
            courseName     : arr[2],
            beginAt        : arr[3],
            description    : arr[4]
        
        }

        localStorage.setItem("data", JSON.stringify(data));

        // {"row" : [ {"modules" : 1 , "teacher" : 2, ...} ] }
        
               
        window.location.href = "/editCourse.php";
        
    });
    
});

