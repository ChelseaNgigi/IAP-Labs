<?php
include_once 'DBConnector.php';
include_once 'user.php';
//Database connection is made
$con=new DBConnector;

//data insert code
if(isset($_POST['btn-save'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $city=$_POST['city_name'];
//Create user object using constructor(To initialize the variables)
$user=new User($first_name,$last_name,$city);
$res=$user->save();

//Check if save operation is successful
if($res)
{
    echo "Save operation was successful";
}
else{
    echo "An error occurred";
}

$con->closeDatabase();
}


?>
<html>
    <head>
        <title>Title goes here</title>
        <link rel="stylesheet" type="text/css" href="lab1.css">
    </head>
<body>
    <form method="POST">
        <table id ="user" action="<?=$_SERVER['PHP_SELF']?>">
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
                    <td><button type="submit"  class="savebtn" name="btn-save" ><strong>SAVE</strong></button></td>
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

            </tr>

            <?php
            //data retrieve code

//Create user object using constructor(To initialize the variables)
$userdetails=new User($first_name,$last_name,$city);
$result=$userdetails->readAll();
$con->closeDatabase();
//echo "</table>";            
 ?>                                   
       
     </table>
      
</div>

</body>
</html>




