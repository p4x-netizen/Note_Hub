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
    <title>Login</title>
</head>
<body>
      <div class="container">
        <?php
        require_once "connect.php";
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            if($user){
               if(password_verify($password, $user['password'])){
                session_start();
                $_SESSION['user'] = 'yes';
                $_SESSION['user_id'] = $user_id;
                header("Location: index.php");
                die();
               }
               else{
                echo "<div class='alert alert-danger'>Password does not match</div> <br>";
               }
            }
            else{
                echo "<div class='alert alert-danger'>Email does not exist</div> <br>";
            }
        }

        ?>
     <form action="login.php" method="post">
        <div class="h1">Welcome to NoteHub</div><br><hr><br>
            <div class="form-group">
                <input type="text" name="email" placeholder="johndoe@gmail.com" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="pass"  class="form-control" placeholder="password">
            </div>
             <div class="form-group">
                <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div><br>
            <div><p>Not Registered yet? <a href="register.php">Register</a></p></div>
    </form>
</div>
</body>
</html>
