<?php
include "crud.php";
include "authenticator.php";
include_once "DBConnector.php";




class User extends DBConnector implements Crud,Authenticator 
{
private $user_id;
private $first_name;
private $last_name;
private $city_name;



//Class constructors-initialize our values 
//Member variables cannot be instantiated from elsewhere(private)
function __construct($first_name,$last_name,$city_name,$username,$password)
{
   
    $this->first_name=$first_name;
    $this->last_name=$last_name;
    $this->city_name=$city_name;
    $this->username=$username;
    $this->password=$password;
}
//static method -to access it with class rather than an object
public static function create()
{
$instance=new self();
return $instance;
}
//username setter
public function setUsername($username)
{
$this->username=$username;
}
//username getter
public function getUsername()
{
return $this->username;
}
//password setter
public function setPassword($password)
{
$this->password=$password;
}
//password getter
public function getPassword()
{
return $this->passsword;
}
//user_id setter
public function setUserId($user_id)
{
$this->user_id=$user_id;
}
//user_id getter
public function getUserId()
{
return $this->$user_id;
}
//Must define all methods in the crud interface because User class has implemented Crud
public function userExist(){
    $uname=$this->username;
    $con=new DBConnector;
    $result=mysqli_query($con->conn,"SELECT username FROM user WHERE username='$uname'");
    if(mysqli_num_rows($result)>0){ 
        $con->closeDatabase(); 
        return true;    
    }
    return false;
    
}
public function save()
{
    $fn=$this->first_name;
    $ln=$this->last_name;
    $city=$this->city_name;
    $uname=$this->username;
    $this->hashPassword();
    $pass=$this->password;
    //$sql="INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')";
    //$res=mysqli_query(parent:$this->conn,$sql) or die("Error:".mysqli_error(parent:$this->conn));
    if($this->userExist()==true){
        echo "Username already exists";
        header("Refresh:0");
        die();   
    
    }
    else{
    $con=new DBConnector;
    $res=mysqli_query($con->conn,"INSERT INTO user(first_name,last_name,user_city,username,password) VALUES ('$fn','$ln','$city','$uname','$pass')");
     return $res;
    }
}
public function readAll()
{
    
    //$sql="SELECT * FROM `user`ORDER BY `ID` DESC";
    //$result=$this->connect()->query(mysqli);
    $con=new DBConnector;
    $result=mysqli_query($con->conn,"SELECT * FROM `user`ORDER BY `ID` DESC");
    while($row=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['user_city'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
    
    }
    echo "</table>";
   
}
    public function readUnique()
    {
        return null;
    }
    public function search()
    {
        return null;
    }
    public function update()
    {
        return null;
    }
    public function removeOne()
    {
        return null;
    }
    public function removeAll()
    {
        return null;
    }
    public function validateForm()
    {
$fn=$this->first_name;
$ln=$this->last_name;
$city=$this->city_name;
if($fn==""||$ln==""||$city==""){
        return false;
    
}
return true;
    }
    public function createFormErrorSessions(){
        session_start();
        $_SESSION['form_errors']="All fields are required";
    }
    //hashes password
    public function hashPassword()
    {
$this->password=password_hash($this->password,PASSWORD_DEFAULT);
    }
    public static function isPasswordCorrect($username,$password)
    {
$con=new DBConnector;
$found=false;
$res=mysqli_query($con->conn,"SELECT * FROM user");

while($row=mysqli_fetch_array($res)){
    if (password_verify($password,$row['password'])&& $username==$row['username']){
        $found=true;
    }
}
//close database
$con->closeDatabase();
return $found;
//return true
 }
    public static function login($username,$password)
    {
        if(User::isPasswordCorrect($username,$password))
        {
        //password corrrect-load protected page
        header("Location:private_page.php");
        }
    }
    public static function createUserSession($username)
    {
    session_start();
    $_SESSION['username']=$username;
    }
    public static function logout()
    {
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    
    }
   
    
        

    
}
?>