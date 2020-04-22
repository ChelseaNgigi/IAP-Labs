<?php 
//define()function defines a constant
//Constants-cannot be changed
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','ics3104');

class DBconnector
{
    public $conn;

    function __construct(){}
        public function connect()
        {
        $this->conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die("Error:".mysqli_error());
        mysqli_select_db($this->conn,DB_NAME);
        return $this->conn;
        }
    public function closeDatabase(){
        mysqli_close($this->conn);

    }
}

?>
