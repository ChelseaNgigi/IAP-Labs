<?php
include_once 'DBConnector.php';
include 'user.php';

$con=new DBConnector;
if(isset($_POST['btn_login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    //$instance=User::create();
   //$username->setPassword($password);
   //$username->setUsername($username);
   
    if(User::isPasswordCorrect($username,$password)){
       User::login($username,$password);
        //close database connection
        $con->closeDatabase();
        //create user session
         User::createUserSession($username);
       
    }
    else{
       $con->closeDatabase();
       header("Location:login.php");
    }
}
?>
<html>
    <head>
        <title>Title goes here</title>
        <script type="text/javascript" scr="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <!--'=$_SERVER['PHP_SELF']means that we are submitting this form to itself for processing-->
    <form method="post" name="login" action="<?=$_SERVER['PHP_SELF']?>">
    <table id="login">
        <tr>
            <td><input type="text" name="username" placeholder="Username" required/></td>
</tr>
<tr>
    <td><input type="password" name="password" placeholder="Password" required/></td>
</tr>
<tr>
    <td><button type="submit" name="btn_login"><strong>LOGIN</strong></button></td>
</tr>

</table>
</form>
</body>
</html>