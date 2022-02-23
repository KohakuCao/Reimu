<?php
require_once($_SERVER["DOCUMENT_ROOT"]."includes/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."includes/upload.class.php");
if($_POST["f"]=="Check"){
    $username=$_POST["username"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $identity=$_POST["identity"];
    $user=new User();
    $user->updateObj(username: $username,phone: $phone,email: $email,identity: $identity);
    $user->Check();
}
?>