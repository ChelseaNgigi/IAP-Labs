<?php
include "crud.php";



class User extends DBConnector implements Crud 
{
private $user_id;
private $first_name;
private $last_name;
private $city_name;

//Class constructors-initialize our values 
//Member variables cannot be instantiated from elsewhere(private)
function __construct($first_name,$last_name,$city_name)
{
   
    $this->first_name=$first_name;
    $this->last_name=$last_name;
    $this->city_name=$city_name;
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
public function save()
{
    $fn=$this->first_name;
    $ln=$this->last_name;
    $city=$this->city_name;

    $res=$this->connect()->query("INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')");
    //$sql="INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')";
    //$res=mysqli_query(parent:$this->conn,$sql) or die("Error:".mysqli_error(parent:$this->conn));
     return $res;
}
public function readAll()
{
   
    //$sql="SELECT * FROM `user`ORDER BY `ID` DESC";
    //$result=mysqli_query(mysqli,$sql);
    $result=$this->connect()->query("SELECT * FROM `user`ORDER BY `ID` DESC");
    while($row=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['user_city'] . "</td>";
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
}
?>