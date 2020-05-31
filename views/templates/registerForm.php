<form action="/register.php">
  <div class="containerRegister">
    <h1>Register</h1>
    <label>Lastname</label>
    <input type="text" placeholder="Enter Lastname" name="lastname" id="lastnameForm" required>
    <label>Firstname</label>
    <input type="text" placeholder="Enter Firstname" name="Firstname" id="firstnameForm" required>
    <label>E-mail</label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>
    <label>Password</label>
    <input type="password" placeholder="Enter password" name="password" id="password" required>
    <input type="radio" name="fk_role" value=1>
    <label for="teacher">Teacher</label>
    <input type="radio" name="fk_role" value=2>
    <label for="student">Student</label>
    <br>
    <input type="submit">
</form>