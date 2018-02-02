<?php

/**
 * @var string $content
 */

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">
    <?= $content ?>
</main>

<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; <?= date('Y')?> PHP Academy</span>
    </div>
</footer>

<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>
</html>