 <?php
        include "connect.php";
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $note = $_POST['note'];
            $datetime = $_POST['datetime'];
            $errors = array();
            if(empty($title) OR empty($note) OR empty($datetime)){
                array_push($errors, "All fields are required!!");
            }
            if(($errors)>0){
                foreach($errors as $error){
                   echo "<div class='alert alert-success'>$error</div><br>";
                }
            }

            $sql = "UPDATE notes SET title = '$title', note='$note', datetime = '$datetime' WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            if($result){
                session_start();
                $_SESSION['edit'] = "Note edited succesfully!!";
                header("LOcation: index.php");
            }
            else{
               die("something went wrong!!");
            }
        }

        ?>
