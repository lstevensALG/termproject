<?php
    include "../directory.php";
    $webpageTitle = "Sign Up Submit";
    include SITE_ROOT."/includes/header.php";
    include SITE_ROOT."/db/dbConnection.php";
?>

<div class="container">
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

                    //SQL queries for creating a table and inserting a record to a table
                    $sqlTableCreate = "CREATE TABLE IF NOT EXISTS termproject_profiles (profile_id INTEGER PRIMARY KEY AUTO_INCREMENT, profile_username TEXT NOT NULL, profile_password TEXT NOT NULL)";
                    $sqlTableInsert = "INSERT INTO termproject_profiles (profile_username, profile_password) VALUES ('$username', '$password')";
                    
                    //Create table if it doesn't exist
                    mysqli_query($conn, $sqlTableCreate);

                    //Insert to table
                    if (mysqli_query($conn, $sqlTableInsert)) {
                        echo "Record added successfully!";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                }
            ?>
        </div>
    </div>
</div>



<?php
    include SITE_ROOT."/includes/footer.php";
?>