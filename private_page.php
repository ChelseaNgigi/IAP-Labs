<?php
//call method start_session()
//proceed by checking if the session is set
//If not,direct user to login page
//Otherwise user is allowed to view the page

session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
?>
<html>
    <head>
        <title>Title goes here</title>
        <script type="text/javascript" scr="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <p>This is a private page</p>
    <p>We want to protect it</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
