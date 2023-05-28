<?php
    require('../../db/db.php');
    session_start();
if(!isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
<?php

    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $validationKey = $row["validation_key"];
        echo $validationKey;

        if ($rows == 1) {
            $validationKey = $row["validation_key"];
            $isActive = $row["is_active"];
            
            if($isActive == 1){
                $_SESSION['username'] = $username;
                // Redirect to user dashboard page
                header("Location: ../dashboard/dashboard.php");
            }
            elseif($isActive == 0){

                echo "<div class='form'>
                <h3>Please activate your account to continue login</h3><br/>
                <form class='formActivaation' method='post' name='activation' action='activate.php'>
                <input type='text' class='login-input' name='validation_key' placeholder='Code'/>
                <input type='hidden' class='login-input' name='username' value=".$_POST['username']." />
                <input type='hidden' class='login-input' name='validation_form' value=".$validationKey." />

                <input type='submit' value='Activate' name='submit' class='login-button'/>
                <p class='link'>Activate account for login.</p>
                </form>
                </div>";
                
            }
            
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="../registration/registration.php">New Registration</a></p>
    </form>
<?php
    }
?>
</body>
</html>
<?php
    }
    else{
        header("Location: ../dashboard/dashboard.php");
    }
?>