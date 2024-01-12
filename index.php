<?php
$page_title = "Home";
if (isset($_GET['n'])) {
    $action = $_GET['n'];
}
require("head.php");
?>

<!--Carousel-->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/carousel1x.jpg" width="100%">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Meats & Salads</h1>
                    <p>Right from our kitchen</p>
                    <p onclick="slider()"><a class="btn btn-lg btn-primary" href="#">Order today</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/carousel2x.jpg" width="100%">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Example Carousel Item 2</h1>
                    <p>Placeholder text for Carousel 2</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Browse meals</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/carousel3x.jpg" width="100%">
            <div class="container">
                <div class="carousel-caption text-end text-dark">
                    <h1>Example Carousel Item 3</h1>
                    <p>Placeholder text for Carousel 3</p>
                    <p><a class="btn btn-lg btn-primary" href="#">About us</a></p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!--Punny Section-->
<div class="container-fluid text-left py-5 "
     style="background-image: url(assets/img/coverbg-p-gb15px.jpg)">

    <div class="container col-xs-3 col-lg-8 p-5 p-lg-2">
        <h1 class="display-4 fw-normal" style="color: white">Hungry?<br>Get your meal fast with<br><b> Clean Plate!</b>
        </h1>
        <p class="lead fw-normal" style="color: white">
            Did you know?
            <br>
            Getting home-delivered food is more than your life made easy. When you order with Clean Plate, you help
            thousands
            of hard-working restaurant and store owners and couriers make a living.
            You can choose meals from our 100+ local partners.
        </p>
        <a class="btn btn-outline-secondary" onclick="displayNotify('success','Logged in!')" href="#">Coming soon</a>
    </div>
</div>

<!--Features-->
<div class="container-fluid" style="background: #000">
    <br>
    <div class="container">
        <div class="row featurette bg-dark rounded p-5  shadow-lg">

            <div class="col-md-9">
                <h2 class="featurette-heading text-white">Super easy use,<span
                            class="text-muted"> mind blowing meals fast & cheap </span></h2>
                <p class="text-white"><br>Our team, Clean Plate, is focusing on precise and fast delivery.
                    With Clean Plate, you can order easily from our partner restaurants in seconds! </p>
            </div>
            <div class="col-md-3">
                <img src="assets/img/CP-F-1.jpg" width="100%" class="rounded shadow-lg" >

            </div>

        </div>
    </div>
    <div class="container">
        <hr class="featurette-divider bg-primary ">
        <div class="row featurette bg-dark rounded shadow p-5">
            <div class="col-md-3">
                <img src="assets/img/CP-F-2.jpg" width="100%" style="border: #2E4756 5px solid;border-radius: 80px">

            </div>
            <div class="col-md-9">
                <h2 class="featurette-heading text-white">Eco friendly,<span
                            class="text-white"> delivery system </span></h2>
                <p class="text-white"><br>Clean Plate is focusing on reduction of harmful emissions, we have 250+ courier
                    workers...
                    Right after the order checkout, your meal arrive in time</p>
            </div>

        </div>
    </div>
    <br>
</div>
<?php
if (isset($action)) {
    switch ($action){

        case 3 :
            echo '<script>displayNotify("success","Successfully logged in!")</script>';
            $action = 0;
            break;
        case 4 :
            echo '<script>displayNotify("error","You have to log in first!")</script>';
            $action = 0;
            break;
        case 5 :
            echo '<script>displayNotify("error","You have already logged in!")</script>';
            $action = 0;
            break;
        case 6 :
            echo '<script>displayNotify("error","You can\'t access this page!")</script>';
            $action = 0;
            break;

    }
}
require("footer.php");
?>
