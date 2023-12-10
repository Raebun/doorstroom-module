<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/general.css" rel="stylesheet">
    <link href="public/css/nav.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    include 'navigation.php';
    include 'headerTitle.php';
}
?>
<div class="container-main">

