<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
<div>
    <h1>Oops, something went wrong!</h1>
    <?php
    $errorMessage = isset($error) ? $error : 'Unknown error.';
    echo "<p>{$errorMessage}</p>";
    ?>
</div>
</body>
</html>