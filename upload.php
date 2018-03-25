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

if (isset($_POST['submit'])){
    $file = $_FILES['file']; //SUPER GLOBAL TO GET INFO FROM FILE
    
    //PUTTING INFORMATION ONTO PLACEHOLDERS
    $fileName    = $_FILES['file']['name'];     //FILE NAME
    $fileTmpName = $_FILES['file']['tmp_name']; //TEMPORARY LOCATION
    $fileSize    = $_FILES['file']['size'];     //FILE SIZE
    $fileError   = $_FILES['file']['error'];    //IF THERE ARE ERRORS
    $fileType    = $_FILES['file']['type'];     //FILE TYPE
    
    $fileExt = explode('.', $fileName); //WILL SEPERATE WORDS THAT HAS A PERIOD IN BETWEEN TO GET THE EXTENSION NAME OF THE FILE
    $fileActualExt = strtolower(end($fileExt)); //MAKING EXTENSION LOWERCASE SO IT CAN BE IDENTIFIED BY FOLLOWING STATEMENTS
    
    //FILE TYPES THAT ARE ALLOWED    
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'mp4', 'txt');
    
    
    if (in_array($fileActualExt, $allowed)){  //CHECK IF FILE IS ALLOWED
        if($fileError === 0){                 //CHECK IF THERE IS NO ERROR
            if($fileSize < 1000000){          //CHECK FILE SIZE
                
                //ASSIGN A NEW ID SO THERE WILL BE NO FILES ARE ARE GOING TO BE OVERWRITTEN -- JUST TO MAKE SURE
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                
                //FILE DESTINATION
                $fileDestination = 'uploads/'.$fileNameNew;
                
                //MOVE THE FILE ONTO THE FILE DESTINATION
                move_uploaded_file($fileTmpName, $fileDestination);
                
                
                //SUCCESSFUL UPLOAD
                //header("Location: http://nashelsky.com/appdbms/success.php");
                echo $fileNameNew . " uploaded successfully";
                
                //PUT INTO THE DATABASE
                $file = fopen('uploads/'.$fileNameNew, "r") or die("Unable to open file!");

                while(!feof($file)){
                    //openedfile reassignment
                    $data = fgets($file);   
                    //split lines
                    $line = explode(",", $data);

                    $eno  = $line[0];
                    $comp = $line[1];
                    $name = $line[2];
                    $sex  = $line[3];
                    $race = $line[4];
                    
                    //entering data
                    $sql = "INSERT INTO emp (eno, comp, name, sex, race)
                    VALUES ('$eno', '$comp', '$name', '$sex', '$race')";
                     
                    //--checking if it was uploaded to table
                    if ($db->query($sql) === TRUE) {
                    echo "<br>New record created successfully";
                } else {
                    echo "<br>Error: " . $sql . "<br>" . $conn->error;
                }
               

                }

                
            } else {
                echo "Your file is too big.";
            }
        } else {
            echo "Error uploading your file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }
    
} else {
    
    echo "error";
}
?>

<html>
    CONTENT HERE <br>
</html>
