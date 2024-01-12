<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php?n=4");
}
//var_dump($_SESSION);
$page_title = "Settings";
require("head.php");
?>

<div class="container">
    <div class="my-5 p-3 bg-white rounded box-shadow shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Account Settings</h6>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Username</strong>
            <?php echo $_SESSION['user']['username'],'<br>';?>
            </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">E-Mail</strong>
                <?php echo $_SESSION['user']['email'],'<br>';?>
            </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">City</strong>
                <?php echo $_SESSION['user']['city'],'<br>';?>
            </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Postal Code</strong>
                <?php echo $_SESSION['user']['zip'],'<br>';?>
            </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Address</strong>
                <?php echo $_SESSION['user']['address'],'<br>';?>
            </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Phone number</strong>
                <?php echo $_SESSION['user']['phone'],'<br>';?>
            </p>
        </div>
    </div>
</div>
<?php
require ("footer.php");
?>