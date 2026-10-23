<?php
include "connect.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM notes WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result)
        session_start();
        $_SESSION['delete'] = "Note deleted successfully!!";
        header("Location: index.php");
    }


?>
