<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming Website</title>
    <link rel="stylesheet" href="styles.css<?php echo time(); ?>">

</head>
<body>
    <?php session_start(); ?>
    <?php require_once('../model/header.php'); ?>
    <?php include('../model/banner.php'); ?>
   
    <?php include('../model/typeMovie.php'); ?>

    <?php include('../model/newMovie.php'); ?>
    <?php include('../model/category.php'); ?>
    <?php include('../model/movieTop.php'); ?>

    <?php include('../model/footer.php'); ?>
</body>
</html>
