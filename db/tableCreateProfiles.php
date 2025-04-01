<?php
    //include dbConnection.php before including this
    $sqlTableCreateProfiles = "CREATE TABLE IF NOT EXISTS termproject_profiles (
        profile_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        profile_username VARCHAR(255) NOT NULL,
        profile_password VARCHAR(255) NOT NULL,
        profile_pic VARCHAR(50) NOT NULL,
        profile_description VARCHAR(255) NOT NULL
    )";

    $stmt = $conn->prepare($sqlTableCreateProfiles);
    $stmt->execute();
?>