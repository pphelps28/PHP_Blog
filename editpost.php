<?php
require('config/config.php');
require('config/db.php');

//Check for submit
if (isset($_POST['submit'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "UPDATE posts SET
        title='$title',
        author= '$author',
        body= '$body'
        WHERE id= {$update_id}";

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
        <h1 class="text-secondary">Add Post</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo  $post['title']; ?>">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
            </div>
            <div class=" form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control"><?php echo $post['body']; ?></textarea>
            </div>
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </form>
    </div>
    <?php include('inc/footer.php'); ?>