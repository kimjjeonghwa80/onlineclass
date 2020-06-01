<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/js/home.js"></script>
    <title>Online Class</title>
</head>
<div class="navbar">
    <a href="/">HOME</a>
    <a href="/login.php">LOGIN</a>
    <a href="#">COURS</a>
    <a href="#">USER</a>
</div>
<body>
    <pre>
    <?= $this->__get('page'); ?>
    <?= var_dump($this); ?>
</body>
</html>