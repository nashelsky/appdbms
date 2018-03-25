<?php
//CONNECT TO DATABASE
//IF YOU WANT TO CHANGE THE DATABASE IT CONNECTS TO, FOLLOW INSTRUCTIONS PROVIDED
$servername = "localhost";      //DO NOT CHANGE
$username   = "nashelsky";      //USERNAME FOR DATABASE
$password   = "Nashelsky6194_"; //PASSWORD FOR DATABASE
$dbname     = "appdbms";        //DATABASE NAME WHERE TABLE IS

//CREATE THE CONNECTION
$db = new mysqli($servername, $username, $password, $dbname);

//CHECK THE CONNECTION ---------------------------------------
//IF IT DID NOT CONNECT
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>



<html>
<title>registration</title>
<form method="POST" action=""> 
<b>username: </b><input type="text" name="username">
<b>password: </b><input type="text" name="password"> 
<b>email:</b> <input type="text" name="email"> 
<br>
<input class="button" id="button" type="submit" name="submit" value="Sign-Up">
</form>
</html>


<?
//IF IT CONNECTS

     if(isset($_POST['submit']))
    {
         $username = $_POST['username'];
         $password = $_POST['password'];
         $email    = $_POST['email'];


         $greet = "Hello ";
         $period = "!";
         $sql = "INSERT INTO users (username, password, email) VALUES('$username', '$password', '$email'); ";

         if ($db->query($sql) === TRUE) {
            echo "Thank you for registering ". $username . "!</font></p>";
              }
         else {
            echo $greet . $username . $period . "  It looks like someone already registered.";
    }     
}
?>