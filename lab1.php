<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

//Database connection is made
$con=new DBConnector;

//data insert code
if(isset($_POST['btn-save'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $city=$_POST['city_name'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $picName = $_POST[$_FILES["profilePic"]["name"]];
    $utc_timestamp=$_POST['utc_timestamp'];
    $offset=$_POST['time_zone_offset'];



    
//Create user object using constructor(To initialize the variables)
$user=new User($first_name,$last_name,$city,$username,$password,$picName,$utc_timestamp,$offset);
//create object for file uploading
$uploader=new FileUploader();

if(!$user->validateForm()){
    $user->createFormErrorSessions();
    header("Refresh:0");
    die();
}
/*if($user->isUserExist($username)){
    session_start();
    $_SESSION['form_errors'] = "Sorry, the username '".$username."' is already in use. Please enter another";
    header("Refresh:0");
    die();
}*/

//call uploadFile() function,which returns
if($uploader->uploadFile()){
    $res = $user->save();
}
else{ $res = false; 
    session_start();
    $_SESSION['form_errors'] = "Error in profile image upload please try again";
    header("Refresh:0");
    die();
}

if($res){
    session_start();
    $_SESSION['form_success'] = "Save operation successful!";
    header("Refresh:0");
    die();
}
else{
    session_start();
    $_SESSION['form_errors'] = "Save operation failed!...Please try again";
    //header("Refresh:0");
    die();
}

$con->closeDatabase();
}


?>
<html>
    <head>
        <title>Title goes here</title>
        <script type="text/javascript" scr="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">

        <!--include jquery here.I decide to get it from a cnd network,Google-->
        <script scr="https://ajaz.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--your new js file after including your jquery-->
        <script type="text/javascript" src="timezone.js"></script>
    </head>
<body>
    <form method="POST" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
        <table id ="user" action="<?=$_SERVER['PHP_SELF']?>">
        <tr>
            <td>
                <div id="form-errors">
                    <?php
                    session_start();
                    if(!empty($_SESSION['form_errors'])){
                        echo " " .$_SESSION['form_errors'];
                        unset($_SESSION['form_errors']);
                    }
            
                    ?>
                    </div>
                </td>
                </tr>
            <tr>
                <td><input type="text" name="first_name" required placeholder="First Name"/></td>
            </tr>
            <tr>
                    <td><input type="text" name="last_name" placeholder="Last Name"/></td>
            </tr> 
            <tr>
                    <td><input type="text" name="city_name" placeholder="City"/></td>
             </tr>
             <tr>
                    <td><input type="text" name="username" placeholder="Username"/></td>
             </tr>
             <tr>
                    <td><input type="password" name="password" placeholder="Password"/></td>
             </tr>
             <tr>
                    <td>Profile Image:<input type="file" name="fileToUpload" id="fileToUpload"></td>
             </tr>
             <tr>
                    <td><button type="submit"  class="savebtn" name="btn-save" ><strong>SAVE</strong></button></td>
                </tr>
                <!--Create hidden controls to store client utc date and time zone-->
                <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
                <input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>


                <tr>
                    <td><a href="login.php">Login</a></td>
                </tr>

        </table>
    </form>
    <br>
 <br>
        <div id="table">
        <table class="table">
        <tr>
            
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Username</th>
            <th>Password</th>

            </tr>

            <?php
            //data retrieve code

//Create user object using constructor(To initialize the variables)
$userdetails=new User($first_name,$last_name,$city,$username,$password,$picName,$utc_timestamp,$offset);
$result=$userdetails->readAll();
$con->closeDatabase();
//echo "</table>";            
 ?>                                   
       
     </table>
      
</div>

</body>
</html>




