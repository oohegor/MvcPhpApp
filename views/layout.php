<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        // google reCaptcha
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "UA-29054966-10");
    </script>

    <title>MVC PHP APP</title>
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']) . '/css/style.css' ?>">
</head>
<body>
    <header></header>

    <?php if(!empty($data['contentOfView'])) include $data['contentOfView'] ?>

    <footer></footer>
    <script src="<?php echo dirname($_SERVER['PHP_SELF']) . '/js/script.js' ?>"></script>
</body>
</html>