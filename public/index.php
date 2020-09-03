<?php include('../app/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $view->getTitle(); ?></title>
    <link rel="icon" href="<?php echo PATH_IMG; ?>hotel.png">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>main.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6f77e9fc62.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- info kontaktowe + ikony social media -->
    <header class="dark-bg">
        <div class="center80 container-flex h50px">
            <div>
                <span>
                    <i class="fas fa-phone"></i> (123) 456-789-1230
                </span>
                <span class="margin-left-20">
                    <i class="fas fa-envelope"></i> info@gmail.com
                </span>
            </div>
            <div>
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter margin-left-20"></i>
                <i class="fab fa-instagram margin-left-20"></i>
                <i class="fab fa-tripadvisor margin-left-20"></i>
            </div>
        </div>
    </header>

    <!-- logo + menu nagigacyjne -->
    <nav class="center80 container-flex">
        <div>
            <a href="/"><img src="<?php echo PATH_IMG; ?>logo.png" alt="Logo"></a>
        </div>
        <?php include('../app/nav.php'); ?>
    </nav>

    <?php

    $model = $controller->$method($params);
    echo $view->output($model);

    ?>

    <footer class="dark-bg">
        <div class="center80 c-flex-start-space padding-top-bottom">
            <div>
                <h1>Hotel</h1>
                <p class="line-height">(123) 456-789-1230</p>
                <p class="line-height">info@gmail.com</p>
                <p class="line-height">123 Moutain Street, 43-988 IL, Chicago</p>
            </div>
            <div>
                <h1>Links</h1>
                <?php include('../app/nav.php'); ?>
            </div>
            <div id="newsletter">
                <h1>Newsletter</h1>
                <p>Subscribe, so you have all the latest info!</p>
                <input id="email-newsletter" type="text" placeholder="Enter email" />
                <button id="btn-newsletter"><i class="fas fa-paper-plane"></i></button>
                <p id="newsletter-answer"></p>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="<?php echo PATH_JS; ?>/script.js"></script>
</body>
</html>