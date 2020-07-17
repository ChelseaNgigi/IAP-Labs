<?php
include_once 'DBConnector.php';

//call method start_session()
//proceed by checking if the session is set
//If not,direct user to login page
//Otherwise user is allowed to view the page

session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}

function fetchUserAPIKey(){
    $username = $_SESSION['username'];
    $con = new DBConnector();
    
    $sql = "SELECT api_key FROM api_keys WHERE username = '$username'";
    $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
  
    if ($res->num_rows <= 0) {
        return 'Please generate an API Key';
    }else{
        while($row = $res->fetch_array()){
            $api_key = $row['api_key'];
        }
    }
    
    return $api_key;
}
?>
<html>
    <head>
        <title>Title goes here</title>
        <script src="jquery-3.1.1.min.js"></script>
        <script type="text/javascript" scr="validate.js"></script>
        <script type="text/javascript" src="apikey.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
        <!--Bootstrap file-->
        <!---js--->
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="bootsrap/js/bootstrap.min.js"></script>

        <!--css-->
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">


</head>
<body>
    <p>This is a private page</p>
    <!--p>We want to protect it</p>
    <p><a href="logout.php">Logout</a></p-->
    <p align='right'><a href="logout.php">Logout</a></p>
        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">Generate APi key</button> <br> <br>

        <!---The text area below will hold the APi key-->
        <strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating new key will stop the application from functioning) <br>

        <textarea name="api_key" id="api_key" cols="100" rows="2" readonly><?php echo fetchUserApiKey();?></textarea>

        <h3>Service Description:</h3>
        We have a service/API that allows extrenal applications to order food and also pull all order status by using order id. Let's do it

        <hr>

</body>
</html>

<?php

session_start();

include_once 'DBConnector.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        //Dont allow a user to access the page via the url
        header('HTTP/1.0 403 Forbidden');
        echo 'You are forbidden';
    }else{
        $api_key = null;
        //Generate a 64 character long key
        $api_key = generateApiKey(64);
        header('Content-type: application/json');
        //Response if its in json
        echo generateResponse($api_key);
    }

    //API Key generation
    function generateApiKey($str_length){
        // Base 62 map
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //get enough bits for base 64 encoding (and prevent '=' padding)
        // +1 is better than ceil()
        $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);
        //convert base 64 to base 62 mapping + and / to something from the base 62 map
        //Use the first 2 random bytes for the new characters
        $repl = unpack('C2',$bytes);
  
        $first = $chars[$repl[1]%62];
        $second = $chars[$repl[2]%62];
        return strtr(substr(base64_encode($bytes), 0 ,$str_length), '+/' , "$first$second");
    }

    function saveApiKey($api_key){
        //Function that saves the API for the user currently logged in
        $con = new DBConnector();
        $username = $_SESSION['username'];
        $sql = "INSERT INTO  `api_keys`(`username`, `api_key`) VALUES('$username','$api_key')";
        $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
         
        return $res;
    }
      
    function generateResponse($api_key){
        if(saveApiKey($api_key) === TRUE){
          $res = ['success'=> 1, 'message'=> $api_key];
        }else{
          $res = ['success' => 0, 'message'=> "Something went wrong. Please regenerate the API"];
        }
        return json_encode($res);
    }

?>