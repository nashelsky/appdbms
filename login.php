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

//IF IT CONNECTS
else {
    
    //SELECT THE DATABASE YOU WANT TO WORK ON
    mysqli_select_db($db, $dbname) or die ("Could not select database because ".mysqli_error());

    //TRANSFER USER'S RAW INPUT TO PLACEHOLDERS
    $username = $_POST['username'];
    $pw = $_POST['pw'];

    //SQL - IT SELECTS THE WHOLE ROW OF INFORMATION THAT HAS A MATCHING USERNAME AND PASSWORD
    $sql = "SELECT * FROM users         
            WHERE username = '$username' 
            AND password =   '$pw'"  ; 
    
    //ERROR HANDLING IF $SQL HAS AN ERROR
    if(false === $sql){
        echo "there is an error";
    }


    //QUERY ALL THE ROWS THAT ARE A RESULT FROM $SQL, IF THERE ARE NO MATCHES, DISPLAY THE ERROR
    $query = mysqli_query($db, $sql) or die ("Could not match data because ". mysqli_error());
    
    //WILL COUNT THE NUMBER OF ROWS THAT ARE A MATCH TO THE USER'S INPUT ON THE DATABASE
    $num_rows = mysqli_num_rows($query);

    //IF THERE ARE NO MATCHES
    if ($num_rows <= 0) { 
        echo "Sorry, there is no username $username with the specified password.<br>";
        echo "<a href=login.html>Try again</a>";
        exit; 

    //IF THE MATCH IS FOUND
    } else {

        //SAYS IF USER IS LOGGED IN
        setcookie("loggedin", "TRUE", time()+(3600 * 24));
        setcookie("site_username", "$username");
        ?>
<html>
    <head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>
    
<body>
<title>USER PANEL</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!---------------------------------------------------->
<!---------------------------------------------------->
<!----------------------------------------------------> 
<!---------------------------------------------------->    
<?
        echo "<td><h1>You are now logged in " . $username . "<br></h1></td>";
        date_default_timezone_set('America/New_York');
        $t = date("H");
        //GREETING
        echo "<td><h2>";
        if ($t < "12") {
            echo "Good Morning " .   $username . "!<br>";
        } else if ($t >= "13" and $t < "17") {
            echo "Good Afternoon " . $username . "!<br>";
        } else {
            echo "Good Evening " .   $username . "!<br>";
        }
        
        //DATE AND TIME
        echo date("Y/m/d") . " " . date("l") . "<br>";
        echo date("h:i:sa") . "<br>";
        echo "</h2></td>";
?>
<!---------------------------------------------------->
    CONTENT HERE<br>
<!---------------------------------------------------->  
<a href="http://nashelsky.com/appdbms/userupload.php/">upload</a><br>
<a href="http://nashelsky.com/appdbms/count.php/">count</a><br>
<a href="http://nashelsky.com/appdbms/">logout</a>
</body>
</html>

<?
    }
    }

?>

