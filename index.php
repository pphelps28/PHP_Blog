<?php
require('config/config.php');
require('config/db.php');

//Create Query
$query = 'SELECT * FROM posts ORDER BY created_at DESC';

//Get Result
$result = mysqli_query($conn, $query);

//Fetch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <h1 class="text-secondary">Posts</h1>
        <?php foreach ($posts as $post) : ?>
            <div class="jumbotron">
                <h3><?php echo $post['title']; ?></h3>
                <small>Created on <?php echo $post['created_at']; ?> by <span class="text-success"><?php echo $post['author']; ?></span> </small>
                <p><?php echo $post['body']; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        <?php endforeach ?>
    </div>
    <?php include('inc/footer.php'); ?>