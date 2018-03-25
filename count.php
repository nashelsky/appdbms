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
else{
?>
<html>
CONTENT HERE<br>
</html>
<?
//COUNT HOW MANY COMP-----------------------------------------
echo "TOTAL POPULATION PER COMPANIY<br>";
     $sql_sex = "SELECT comp, count(*) AS total FROM emp 
                GROUP BY comp";
     $result = $db->query($sql_sex);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $comp  = $row['comp'];
          $count = $row['total'];

          echo "comp:  $comp count: $count<br>";
        }
    } 
    
    else {
        echo "0 results";
    }
    
echo "<br>";
    
//COUNT HOW MANY SEX------------------------------------------
//WHICH HAS THE MOST FEMALE-----------------------------------
echo "TOTAL FEMALES PER COMPANY<br>";
     $sql_sex = "SELECT sex, comp, COUNT(*) AS total FROM emp
                WHERE sex = 'f'
                GROUP BY comp, sex ORDER BY total DESC LIMIT 5";
     $result = $db->query($sql_sex);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $comp  = $row['comp'];
          $sex   = $row['sex'];
          $count = $row['total'];

          echo "comp:  $comp sex:   $sex count: $count<br>";
        }
    } 
    
    else {
        echo "0 results";
    }

echo "<br>";
 
//WHICH HAS THE MOST MALE-------------------------------------
echo "TOTAL MALES PER COMPANY<br>";
     $sql_sex = "SELECT sex, comp, COUNT(*) AS total FROM emp
                WHERE sex = 'm'
                GROUP BY comp, sex ORDER BY total DESC LIMIT 5";
     $result = $db->query($sql_sex);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $comp  = $row['comp'];
          $sex   = $row['sex'];
          $count = $row['total'];

          echo "comp:  $comp sex:   $sex count: $count<br>";
        }
    } 
    
    else {
        echo "0 results";
    }
    
echo "<br>";
    
//COUNT HOW MANY RACES------------------------------------------
echo "COMPANIES WITH MOST ETHNICITIES<br>";
     $sql_race = "SELECT comp, COUNT(DISTINCT race) AS total FROM emp
                  GROUP BY comp ORDER BY total DESC LIMIT 5";
     $result = $db->query($sql_race);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $comp  = $row['comp'];
          $race   = $row['race'];
          $count = $row['total'];
          echo "comp:  $comp race: $race count: $count<br>";
        }
    } 
    
    else {
        echo "0 results";
    }
       
    
}
       
?>