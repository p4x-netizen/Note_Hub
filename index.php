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
    <title>Notes List</title>
</head>
<style>
    body{
        background: #e0e5ec;
        color: #333;
    }
    .header{
        border: none;
        display: flex;
        justify-content: space-between;
        outline: none;
        background: #e0e5ec;
        padding: 8px 12px;
        margin-top: 30px;
        margin-left: 50px;
        margin-right: 50px;
        border-radius: 12px;
        box-shadow: 4px 4px 8px #a3b1c6,
        -4px -4px 8px #ffff;
    }
    .table-container{
        margin-left: 50px;
        margin-right: 50px;
        padding: 12px 15px;
        background: #e0e5ec;
        color: #333;
        border-radius: 25px;
        box-shadow: 4px 4px 8px #a3b1c6,
        -4px -4px 8px #ffff;
    }
    table{
        background: #e0e5ec;
        color: #333;
        padding: 8px 12px;
        border-radius: 25px;
        box-shadow:inset 4px 4px 8px #a3b1c6,
         inset -4px -4px 8px #ffff;

    }
</style>
<?php
if(isset($_SESSION['create'])){
    ?>
    <div class="alert alert-succes">
        <?php
        echo $_SESSION['create'];
        unset($_SESSION['create']);
        ?>
    </div>
    <?php
}
?>
<?php
if(isset($_SESSION['edit'])){
    ?>
    <div class="alert alert-succes">
        <?php
        echo $_SESSION['edit'];
        unset($_SESSION['edit']);
        ?>
    </div>
    <?php
}
?>
<body>
    <div class="header" >
                <h2>Notes list</h2>
                <a href="create.php" class="btn btn-primary">Add Note</a>
    </div><br><hr><br>
    <div class="table-container">
    <table class="table table-sriped table-hover table-bordered rounded-7">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Note</th>
            <th>Date and Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
            include "connect.php";
            $sql = "SELECT * FROM notes";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
        ?>
            <tr>
                <td> <?php echo $row['id']; ?></td>
                <td> <?php echo $row['title']; ?></td>
                <td> <?php echo $row['note']; ?></td>
                <td> <?php echo $row['datetime']; ?></td>
                <td>
                    <a href="edit.php? id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php? id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>


        <?Php
            }
            ?>
        </tbody>
    </table>

    <a href="logout.php" class="btn btn-warning mx-4 my-6">Log Out</a>
    </div>
</body>
</html>
