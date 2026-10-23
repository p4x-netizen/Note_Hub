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
       $id = $_GET['id'];
       if(isset($_GET['id'])){
            $sql = "SELECT * FROM notes WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
     <form action="process.php" method="post">
            <div class="header">
                <h2>Edit your notes</h2>
                <a href="index.php">Back</a>
            </div><br><hr><br>
        <div class="form-group ">
            <select name="title" class="form-control" style="background: transparent;">
                <option value="">Select Note Category</option>
                <option value="Personal" <?php if($row['title'] == "Personal"){echo "selected";}?>>Personal</option>
                <option value="Work"  <?php if($row['title'] == "Work"){echo "selected";}?>>Work</option>
                <option value="School"  <?php if($row['title'] == "School"){echo "selected";}?>>School</option>
            </select>
        </div>
        <div class="form-group">
            <textarea name="note"  placeholder="Write your note here...."><?php echo $row['note']; ?></textarea class="form-control">
        </div>
        <div class="form-group">
            <input type="datetime-local" name="datetime" value="<?php echo $row['datetime']; ?>" class="form-control" style="background: transparent;" placeholder="24/04/2024">
        </div>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <input type="submit" value="Edit Note" name="submit" class="btn btn-success" style="color: #fff; width: 100px; background: green;">
        </div>
        </form>
        <?php
       }
       ?>
    </div>
</body>
</html>
