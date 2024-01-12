<?php
// Initialize the session
session_start();
$action = NULL;
// Check if the user is already logged in, if yes then redirect him to welcome page
//if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  //  header("location: index.php?n=5");
    //exit;
//}

// Include config file
require 'db_config.php';

$conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . "", USER, PASS);
// Define variables and initialize with empty values
$username = $password = "";
$errors = array();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        array_push($errors, "Please enter username.");
    } else {
        $username = $_POST['username'];
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        array_push($errors, "Please enter your password.");
    } else {

        $password = $_POST['password'];
    }

    // Validate credentials
    if (count($errors) == 0) {
        // Prepare a select statement
        $stmt = $conn->prepare("SELECT u.username, u.passwd , u.validated,u.address,u.city,u.phone,u.email,u.zip,r.role_id FROM users u LEFT JOIN roles r on u.role_id = r.role_id WHERE username = :name AND validated = '1'");
        $stmt->bindParam(':name', $username);
        $stmt->execute();

        $user = $stmt->fetchAll();
        //var_dump($user);
        //If $row is FALSE.
        if ($user === false) {
            //Could not find a user with that username!
            array_push($errors, 'Username does not exists');
        } else {
            //User account found. Check to see if the given password matches the
            //password hash that we stored in our users table.
			 // $validPassword = true;
            $validPassword = password_verify($password, $user[0]['passwd']);

            //If $validPassword is TRUE, the login has been successful.
            if ($validPassword) {

                $_SESSION['user'] = $user[0];
                $_SESSION['user']['permissions'] = [];

                unset($_SESSION['user']['passwd']); // Security...
                $stmt = $conn->prepare("SELECT * FROM `roles_permissions` WHERE `role_id`=?");
                $stmt->execute([$user[0]['role_id']]);

                while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
                    if (!isset($_SESSION['user']['permissions'][$row['perm_mod']])) {
                        $_SESSION['user']['permissions'][$row['perm_mod']] = [];
                    }

                    $_SESSION['user']['permissions'][$row['perm_mod']][] = $row['perm_id'];

                    $_SESSION["loggedin"] = true;



                    switch ($user[0]['role_id']) {
                        case 1:
                            // Redirect user to admin page
                            header("location: admin.php"); //vagy index.php
                            break;
                        case 2:
                            // Redirect registered user to index page
                            header("location: index.php?n=3");
                            break;
                        case 3:
                            // Redirect courir to courir page
                            header("location: courir.php");
                            break;
                        case 4:
                            // Redirect user to courir page
                            header("location: index.php?n=3");
                            break;
                        default:
                            header("location: index.php?n=3");
                            break;
                    }
                    // Redirect user to welcome page
                    // header("location: welcome.php"); //vagy index.php
                }
            } else {
                array_push($errors, 'Invalid password');

            }


        }
    }
}

//verify account after registration

if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {


    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash'];    // Set hash variable

    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . "", USER, PASS);
    $stmt = $conn->prepare("SELECT email, hash, validated FROM users WHERE email= :email AND hash= :hash AND validated = '0'");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        // We have a match, activate the account
        $sth = $conn->prepare("UPDATE users SET validated='1', date=NOW()  WHERE email = :email AND hash= :hash AND validated ='0'");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':hash', $hash);
        $sth->execute();
        $action = 1;
    } else {
        // No match -> invalid url or account has already been activated.
        $action = 2;
    }

}
?>

<?php
$page_title = 'Login';
require 'head.php';
?>
    <style>
        body {
            background-image: url("assets/img/coverbg-p-gb15px.jpg");
        }
    </style>
    <div class="p-3 mx-5-sm bg-white rounded-3 box-shadow shadow container" style="min-height: 400px;max-width: 600px;margin-top:100px;margin-bottom: 150px">
        <br>
        <h2 class="">Login</h2>
        <p class="">Please fill in your credentials to login.</p><?php include('errors.php'); ?>
        <div class="nofity-container"></div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"></span>
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <br>
            <p>Don't have an account? <a href="register3.php">Sign up now</a>.</p>
        </form>
    </div>
    </body>
    </html>

<?php
require 'footer.php';
?>
<?php
if(isset($action)){
    if($action == 1){
        echo '<script>displayNotify("success","Account activated successfully!")</script>';
        $action = 0;
    };
    if($action == 2){
        echo '<script>displayNotify("error","Invalid url or account has already been activated.")</script>';
        $action = 0;
    };

}
?>
