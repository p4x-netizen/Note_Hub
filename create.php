<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
    <title>Add Note</title>
</head>
<style>
    body{
        background: #e0e5ec;
        font-family: sans-serif;
    }
    .container{
        border: none;
        outline: none;
        background: #e0e5ec;
        color: #333;
        border-radius: 12px;
        padding: 8px 12px;
        box-shadow: 4px 4px 8px #a3b1c6,
        -4px -4px 8px #ffff;
    }
    .form-group{
        border: none;
        outline: none;
        background: #e0e5ec;
        color: #333;
        border-radius: 12px;
        padding: 8px 12px;
        box-shadow: inset 4px 4px 8px #a3b1c6,
        inset -4px -4px 8px #fff;
    }
    .form-group{
        border: none;
        outline: none;
        background: transparent;
        font-size: 18px;
    }
    .form-group textarea{
        width: 550px;
        height: 100px;
        background: transparent;
        border: none;
        outline: none;
    }

    .header{
        margin-top: 30px;
        border: none;
        outline: none;
        background: #e0e5ec;
        color: #333;
        border-radius: 12px;
        padding: 8px 12px;
        box-shadow: 4px 4px 8px #a3b1c6,
        -4px -4px 8px #ffff;
        display: flex;
        justify-content: space-between;
    }
    .header a{
        text-decoration: none;
        color: #333;
        background: #e0e5ec;
        font-size: 18px;
        padding: 8px 12px;
        border-radius: 12px;
        box-shadow: 4px 4px 8px #a3b1c6,
        -4px -4px 8px #ffff;

    }
</style>
<body>
    <div class="container">
        <?php
        include "connect.php";
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $note = $_POST['note'];
            $datetime = $_POST['datetime'];
            $errors = array();
            if(empty($title) OR empty($note) OR empty($datetime)){
                array_push($errors, "All fields are required!!");
            }
            if(($errors)>0){
                foreach($errors as $error){
                   echo "<div class='alert alert-danger'>$error</div><br>";
                }
            }

            $sql = "INSERT INTO notes(title, note, datetime) VALUES ('$title', '$note', '$datetime')";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                die("Something went wrong");
            }
            else{
                session_start();
                $_SESSION['create'] = "Note added succesfully!!";
                header("LOcation: index.php");
            }
        }

        ?>
        <form action="create.php" method="post">
            <div class="header">
                <h2>Add your notes</h2>
                <a href="index.php">Back</a>
            </div><br><hr><br>
        <div class="form-group ">
            <select name="title" class="form-control" style="background: transparent;">
                <option value="">Select Note Category</option>
                <option value="Personal">Personal</option>
                <option value="Work">Work</option>
                <option value="School">School</option>
            </select>
        </div>
        <div class="form-group">
            <textarea name="note" id="" placeholder="Write your note here...."></textarea class="form-control">
        </div>
        <div class="form-group">
            <input type="datetime-local" name="datetime" id="" class="form-control" style="background: transparent;" placeholder="24/04/2024">
        </div>
        <div class="form-group">
            <input type="submit" value="Add Note" name="submit" class="btn btn-success" style="color: #fff; width: 100px; background: green;">
        </div>
        </form>
    </div>
</body>
</html>
