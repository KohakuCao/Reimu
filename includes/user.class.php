<?php
require($_SERVER["DOCUMENT_ROOT"]."config.php");
class User{
    public $uid;
    public $username;
    public $name;
    public $sex;
    public $phone;
    public $email;
    public $identity;
    public $qq;
    public $school;
    public $introduction;
    public $sign;

    function updateObj($uid=0,$username="",$name="",$sex=0,$phone=0,$email="",$identity="",$qq=0,$school="",$introduction="",$sign=""){
        $this->uid=$uid;
        $this->username=$username;
        $this->name=$name;
        $this->sex=$sex;
        $this->phone=$phone;
        $this->email=$email;
        $this->identity=strtoupper($identity);
        $this->qq=$qq;
        $this->school=$school;
        $this->introduction=$introduction;
        $this->sign=$sign;
    }

    function Check(){
        $myConnect=mysqli_connect(MY_HOST,MY_USER,MY_PASS,MY_DB,MY_PORT);
        $query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `username`='$this->username';");
        if(mysqli_num_rows($query)!=0){
            echo("username");
        }
        $query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `phone`='$this->phone';");
        if(mysqli_num_rows($query)!=0){
            echo("phone");
        }
        $query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `email`='$this->email';");
        if(mysqli_num_rows($query)!=0){
            echo("email");
        }
        $query=mysqli_query($myConnect,"SELECT id FROM `user` WHERE `identity`='$this->identity';");
        if(mysqli_num_rows($query)!=0){
            echo("identity");
        }

        mysqli_close($myConnect);
        return 0;
    }

    function Login(){

    }
}
?>