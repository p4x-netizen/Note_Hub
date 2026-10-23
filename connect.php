<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'notes';

$conn = new mysqli($server, $username, $password, $dbname, 3306);
if(!$conn){
   echo "Error: {$conn->connect_error}";
}
else{
    echo "";
}

?>
