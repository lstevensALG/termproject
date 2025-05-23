<?php
    include "../directory.php";
    include SITE_ROOT."/php/redirectHome.php";
    $webpageTitle = "Sign Up Submit";
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

                    //Encoding password
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    //SQL queries for checking if username is unique,
                    //and inserting a record into a table
                    $sqlCheckUnique = "SELECT profile_username FROM termproject_profiles WHERE profile_username='$username'";
                    $sqlTableInsert = "INSERT INTO termproject_profiles (profile_username, profile_password, profile_pic, profile_description) VALUES ('$username', '$password', '', '')";
                    
                    //Create table if it doesn't exist
                    include SITE_ROOT."/db/tableCreateProfiles.php";

                    //Check if username is unique
                    if (mysqli_num_rows(mysqli_query($conn, $sqlCheckUnique)) == 0) {
                        //If username is unique, try inserting
                        if (mysqli_query($conn, $sqlTableInsert)) {
                            echo "Profile added successfully!";
                        }
                        //If insertion failed
                        else {
                            echo "Error: " . mysqli_error($conn);
                        }
                    }
                    //if username is not unique
                    else {
                        echo "Error: username is not unique";
                    }
                    

                }
            ?>
        </div>
    </div>
</div>



<?php
    include SITE_ROOT."/includes/footer.php";
?>