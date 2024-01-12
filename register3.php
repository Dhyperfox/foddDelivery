<?php
require 'db_config.php';
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php?n=5");
    exit;
}

// initializing variables

$username = "";
$email = "";
$phone = "";
$zip = "";
$city = "";
$address = "";
$hash = "";
$errors = array();
// Create connection



// Processing form data when form is submitted


if (isset($_POST['buttonSave'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $phone = $_POST['phone'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (strlen($password_1) < 6) {
        array_push($errors, "Password must be at least 6 character");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $stmt = $db_pdo->prepare("SELECT username, email FROM users WHERE username = :user_name OR email= :email");
    $stmt->bindParam(':user_name', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // If account exists
    if ($stmt->rowCount() > 0) {
        array_push($errors, "exists! cannot insert");
    }

    //If no errors in the form write data to database

    if (count($errors) == 0) {
        //Encrypt password

        $hash = password_hash(rand(1000, 10000), PASSWORD_BCRYPT);
        $password = password_hash($_POST['password_1'], PASSWORD_BCRYPT);

        //Prepare a statment

        $stmt = $db_pdo->prepare('INSERT INTO users( username, email, phone, address, city, zip, passwd, hash ) values(:user_name, :email, :phone_num, :address, :city , :zip_code, :passwd, :hash )');
        $stmt->bindValue(':user_name', $_POST['username'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':phone_num', $phone, PDO::PARAM_INT);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':zip_code', $zip, PDO::PARAM_INT);
        $stmt->bindValue(':passwd', $password, PDO::PARAM_STR);
        $stmt->bindValue(':hash', $hash, PDO::PARAM_STR);

        $stmt->execute();


//_SESSION['username'] = $username; //Igazabol nem fontos
//	$_SESSION['success'] = "You are now registered"; //ez se, tovabbi tervezesre var


// Auto mail formazas , cimzett, targy, 

        $to = $email;
        $subject = "validation/test";
        $message = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: ' . $username . '
Password: ' . $password_1 . '
Phone: ' . $phone . '
Zip: ' . $zip . '
City: ' . $city . '
Address: ' . $address . '
------------------------
  
Please click this link to activate your account:
http://skynet.proj.vts.su.ac.rs/CP/login1.php?email=' . $email . '&hash=' . $hash . '
  
'; // Our message above including the link

        $headers = 'From:noreply@skynet.com' . "\r\n"; // Set from headers

        mail($to, $subject, $message, $headers);


        //	header('location: login1.php');
    }

}

?>
<?php
$page_title = 'Register';
require 'head.php';
?>
<style>
    body{
        background-image: url("assets/img/coverbg-p-gb15px.jpg");
    }

</style>

<div class="container bg-white text-dark my-4 p-3 rounded shadow-lg"  style="min-height: 600px;max-width: 600px">
    <br>
    <h2 class="text-dark">Register</h2>
    <form method="post" class="text-dark" action="register3.php">
        <br>
        <?php include('errors.php'); ?>
        <div class="form-group ">
            <label>Username</label><br>
            <input type="text" name="username" class="form-control" value="">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password_1" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input type="password" name="password_2" class="form-control">
        </div>

        <div class="row">
            <div class="form-group" style="max-width: 33%">
                <label>Postal code / Zip code</label>
                <input type="text" name="zip" class="form-control">
            </div>
            <div class="form-group" style="max-width: 33%">
                <label>City</label>
                <input type="text" name="city" class="form-control">
            </div>
            <div class="form-group" style="max-width: 33%">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>


        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="buttonSave">Register</button>
        </div>
        <br>
        <p class="text-muted">
            <b>Already a member?</b> <a href="login1.php">Sign in</a>
        </p>

    </form>
</div>
<?php
require 'footer.php';
?>