<?php
// the message


$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$success = true; 


if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){
    $msg = "Customer name - ".$name."\n Customer email is - ".$email."\n Subject - ".$subject."\n Message".$message."";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    
    // send email
    mail("haykharut3@gmail.com","Offer from novir site",$msg);
}

?>
