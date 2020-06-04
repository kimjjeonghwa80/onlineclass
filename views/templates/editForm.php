<form action="/ajax" method="POST" id="submitRegisterCourse">
  <div class="containerRegister">
    <h1>Edit Course</h1>
    <label for="module">Module</label>
    <select name="fk_module" id="module">
        <!-- //dynamic options -->
    </select>
    <br>
    <br>
    <label for="teacher">Teacher</label>
    <select name="fk_teacher" id="teacher">
        <!-- //dynamic options -->
    </select>
    <br>
    <br>
    <label>Course name</label>
    <input type="text" placeholder="course"         name="courseName"     id="courseName"  required/>
    <label>Start</label>   
    <input type="text" placeholder="date"           name="beginAt"        id="beginAt"     required/>
    <label>Description</label>
    <input type="text" placeholder="description"    name="description"    id="description" required/>
    <br>
    <br>
    <input type="submit" />
</form>