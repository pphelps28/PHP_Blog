<?php
require('config/config.php');
require('config/db.php');

if (isset($_POST['delete'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM posts WHERE id={$delete_id}";

    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . '');
    } else {
        echo 'ERROR: ' . mysqli_error($conn);
    }
}


$id = mysqli_real_escape_string($conn, $_GET['id']);
//Create Query
$query = "SELECT * FROM posts WHERE id=$id";

//Get Result
$result = mysqli_query($conn, $query);

//Fetch Data
$post = mysqli_fetch_assoc($result);
// Free Result
mysqli_free_result($result);

//Close Connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="./config/bootstrap.min.css">
    <link rel="stylesheet" href="./config/style.css">

</head>

<body>
    <div class="container">
        <?php include('inc/navbar.php'); ?>
        <h1 class="text-secondary"><?php echo $post['title']; ?></h1>
        <div class="jumbotron">
            <small>Created on <?php echo $post['created_at']; ?> by <span class="text-success"><?php echo $post['author']; ?></span> </small>
            <p><?php echo $post['body']; ?></p>
            <hr>
            <div id="edit-delete">
                <a href="<?php echo ROOT_URL; ?>/editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">edit</a>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                    <input type="submit" name="delete" value="delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
    <?php include('inc/footer.php'); ?>