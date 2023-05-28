<?php
//include auth_session.php file on all user panel pages
include("../session/auth_session.php");

// mail('haykharut3@gmail.com', 'Тема письма', 'Текст письма', 'From: haykharut3@gmail.com');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are in user dashboard page.</p>
        <p><a href="../login/logout.php">Logout</a></p>
    </div>
</body>
</html>

