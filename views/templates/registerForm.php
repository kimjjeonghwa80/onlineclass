<form action="/ajax" method="POST" id="submitRegister">
  <div class="containerRegister">
    <h1>Register</h1>
    <label>Lastname</label>
    <input type="text" placeholder="Enter Lastname"     name="lastname"     id="lastnameField"  required>
    <label>Firstname</label>
    <input type="text" placeholder="Enter Firstname"    name="firstname"    id="firstnameField" required>
    <label>E-mail</label>   
    <input type="text" placeholder="Enter Email"        name="email"        id="emailField"     required>
    <label>Password</label>
    <input type="password" placeholder="Enter password" name="password"     id="passwordField"  required>
    <input type="radio" name="fk_role" value=1>
    <label for="teacher">Teacher</label>
    <input type="radio" name="fk_role" value=2>
    <label for="student">Student</label>
    <br>
    <input type="submit" >
</form>