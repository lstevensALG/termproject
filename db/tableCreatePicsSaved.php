<?php
    //include dbConnection.php before including this
    $sqlTableCreatePicsSaved = "CREATE TABLE IF NOT EXISTS termproject_pics_saved (
        save_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        pic_id FOREIGN KEY REFERENCES termproject_pics(pic_id),
        profile_id FOREIGN KEY REFERENCES termproject_profiles(profile_id)
    )";

    $stmt = $conn->prepare($sqlTableCreatePicsSaved);
    $stmt->execute();
?>