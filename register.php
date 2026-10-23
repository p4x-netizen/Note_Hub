<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <?php
         require_once "connect.php";
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $username = $_POST['name'];
            $password = $_POST['pass'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();
            if(empty($email) OR empty($username) OR empty($password)){
                array_push($errors, "All fields are required!! <br>");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid!!<br>");
            }
            if(strlen($password)<6){
                array_push($errors, "Password should not be less than 6 characters!! <br>");
            }
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowcount = mysqli_fetch_assoc($result);
            if(($rowcount)>0){
                array_push($errors, "Email already exists!!");
            }
            if(count($errors)>0){
                foreach($errors as $error){
                 echo "<div class='alert alert-danger'>$error</div> <br>";
            }
            }


          $sql = "INSERT INTO user (email, name, password) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
          if($prepareStmt){
            mysqli_stmt_bind_param($stmt, 'sss', $email, $username, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Registration done Succesfully!!</div> <br>";
          }
          else{
            die("Something went wrong!! <br>");
          }

        }

        ?>
        <form action="register.php" method="post">
             <div class="h1">Welcome to NoteHub</div><br><hr><br>
            <div class="form-group">
                <input type="text" name="email" placeholder="johndoe@gmail.com" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" name="name" placeholder="john doe" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Register" class="btn btn-primary">
            </div><br>
            <div><p>Already Registered? <a href="login.php">Login</a></p></div>
        </form>
    </div>
</body>
</html>
