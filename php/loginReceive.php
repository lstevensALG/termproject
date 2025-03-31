<?php
    include "../directory.php";
    include SITE_ROOT."/php/redirectHome.php";
    $webpageTitle = "Log In Submit";
    include SITE_ROOT."/includes/header.php";
    include SITE_ROOT."/db/dbConnection.php";
?>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $username = mysqli_real_escape_string($conn, $username);
                    $password = mysqli_real_escape_string($conn, $password);

                    //Don't encode password

                    //creating table if it doesn't exist to avoid error
                    include SITE_ROOT."/db/tableCreateProfile.php";
                    mysqli_query($conn, $sqlTableCreate);

                    //SQL queriey for matching username and password
                    $sqlMatchInfo = "SELECT * FROM termproject_profiles WHERE profile_username='$username' ";
                    $result = mysqli_query($conn, $sqlMatchInfo);
                    $loginSuccess = FALSE;
                    //Check if there is record with username
                    if (mysqli_num_rows($result) == 1) {
                        $dbRecord = mysqli_fetch_assoc($result);
                        $dbPassword = $dbRecord['profile_password'];
                        $dbID = $dbRecord['profile_id'];
                        //Check if password is same
                        if (password_verify($password, $dbPassword) ) {
                            $loginSuccess = TRUE;
                        }
                        else {
                            echo "Error: incorrect password.";
                        }
                    }
                    //if username is not unique
                    else {
                        echo "Error: username not found.";
                    }
                    
                    if ($loginSuccess) {
                        $_SESSION['profile_id'] = $dbID;
                        $oto = $_SESSION['profile_username'];
                        echo "Welcome, $oto!";
                    }

                }
            ?>
        </div>
    </div>
</div>



<?php
    include SITE_ROOT."/includes/footer.php";
?>