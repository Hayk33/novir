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
$validation_form = $_POST['validation_form'];
$username = $_POST['username'];
$validation_key = $_POST['validation_key'];

echo $validation_form . "|" . $validation_key . "|" . $username;
    // When form submitted, check and create user session.
    if (isset($_POST['validation_key']) && isset($_POST['username']) && isset($_POST['validation_form'])) {
        echo 1;
        if ($validation_form == $validation_key) {
                echo 3;
                $_SESSION['username'] = $username;
                $query    = "UPDATE Users SET is_active=1 WHERE username='$username'";
                $result = mysqli_query($con, $query) or die(mysql_error());
                if ($result === TRUE) {
                    header("Location: ../dashboard/dashboard.php");
                  } else {
                    echo "Error updating record: " . $con->error;
                  }
                  
                  $con->close();
                // Redirect to user dashboard page
                
        } 
    } elseif($validation_form != $validation_key) {
        echo "<h3>Incorrect activation code</h3>";
    }
    else{
        header("Location: ../dashboard/dashboard.php");
    }
?>
<form class="form" method="post" name="activation">
        <h1 class="login-title">Account Activation</h1>
        <input type="text" class="login-input" name="validation_key" placeholder="Code"/>
        <input type="hidden" class="login-input" value="<?=$_POST['username']?>" name="username"/>
        <input type="hidden" class="login-input" value="<?=$_POST['validation_form']?>" name="validation_form"/>
        <input type="submit" value="Activate" name="submit" class="login-button"/>
        <p class="link">If you need any <a href="../help/help.php?problem=activation">Help</a></p>
</form>
  </body>
</html>

<?php
    }
    else{
        header("Location: ../dashboard/dashboard.php");
    }
?>