<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/js/home.js"></script>
    
    <title>Online Class</title>
</head>
<div class="navbar">
    <a href="/">HOME</a>
    <a href="/chatroom.php">CHAT</a>
    <a href="#">COURS</a>
    <a href="#" id="userHome">USER</a>
</div>
<body>
    <h1 id="role"></h1>
    <div class="containerTable">
    <button><a href="#">Create Courses</a></button>
        <table id="tableCourses">
            <tbody>
                <tr>
                    <th>Modules</th>
                    <th>Teacher</th>
                    <th>Courses</th>
                    <th>Start</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </tbody> 
        </table>
    </div>
</body>
</html>