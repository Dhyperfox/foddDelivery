<?php
if (!isset($_SESSION)) {
    session_start();
}
echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="icon" href="assets/img/CP-Main-Ico.ico" type="image/ico" sizes="16x16">
    
    <title> ' . $page_title . ' - Clean Plate</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="assets/js/cleanplate.notify.js"></script>

    <link rel="stylesheet" href="assets/css/cleanplate.foods.css" type="text/css">
    <link rel="stylesheet" href="assets/css/anim.css" type="text/css">
    <style>
        
    </style>
    <!--Color Palette-->
    <!--https://coolors.co/f9a620-ffd449-3c7a89-2e4756-16262e   -->
 


</head>
<body class="bg-light" style="scroll-behavior: smooth">   
 <nav id="navbar" class="navbar navbar-expand-xl navbar-dark sticky-lg-top mr-auto justify-content-center" style="background: #2e4756 ">
    <div class="container-xl">
        <a class="navbar-brand" href="index"><img src="assets/img/CP-Main-W-Nav-v2.png" style="image-rendering: smooth" width="80"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCP"
               aria-controls="navbarCP" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCP">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="foods.php">Foods</a>
                </li>
                
                
            </ul>
            <ul class="navbar-nav navbar-expand-xl">';

if (isset($_SESSION['user'])) {
    echo '<li class="nav-item">
                    <a class="nav-link" href="mycart.php"><i class="bi bi-cart"></i></i> Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php"><i class="bi bi-credit-card-2-back-fill"></i> Checkout</a>
                </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">Profile</a>
                    <ul class="dropdown-menu"  >
                        <li><a class="dropdown-item" href="">Orders</a></li>
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <li><a class="dropdown-item" href="">Support</a></li>
                        <li><a class="dropdown-item" href="session.php">Logout</a></li>
                    </ul>
                </li>';

} else {
    echo '
    <li class="nav-item">
                    <a class="nav-link" href="support.php"><i class="bi bi-chat-right-text"></i> Support</a>
                </li>';
}
echo '
            
            </ul>
            <form>
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            <ul class="navbar-nav navbar-expand-xl">
            ';
if (!isset($_SESSION['user'])) {
    echo '
            
            <li class="nav-item">
                <a href="login1.php"><button class="btn btn-info">Login</button></a> 
            </li>
            <li class="nav-item">
                <a href="register3.php"><button class="btn btn-info">Register</button></a> 
            </li>
            
            </ul>
            
            
        </div>
    </div>
</nav>
';
} else {
    echo '<li class="nav-item text-white" style="margin-left: 5px">
                <p style="margin:0px">Welcome, <b>',
    $_SESSION['user']['username']
    ,'</b></p>
            </li>
            </ul> 
        </div>
    </div>
</nav>';
}