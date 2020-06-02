$(document).ready(function (){

    
    var emailUser = localStorage.getItem("username"); //TODO get the response back to retrieve the username instead of email
    emailUser.toUpperCase();
    /**
     * send post request to fetch all courses and display in table
     */
    $('#userHome').html(emailUser.toUpperCase());
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var rsp = JSON.parse(this.responseText);
            //console.log(this.responseText);
            if(rsp){
                console.log(rsp);
                rsp.forEach((element) => { //loop over object not array
                    $('#tableCourses > tbody:last-child').append(
                        '<tr>'
                            +  '<td class="coursesList">TODO</td>'
                            +  '<td class="coursesList">TODO</td>'
                            +  '<td class="coursesList">' + element['courseName']     + '</td>'
                            +  '<td class="coursesList">' + element['beginAt']        + '</td>'
                            +  '<td class="coursesList">' + element['description']    + '</td>'
                            +  '<td><button class="editCourse">Edit</buton></td>' +
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
     */
    $(document).on("click", "#tableCourses tbody tr td button.editCourse", function(){
        console.log("clicked");
    });
    
});

