<?php
    //include dbConnection.php before including this
    $sqlTableCreatePicsSaved = "CREATE TABLE IF NOT EXISTS termproject_pics_saved (
        save_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        pic_id INTEGER,
        profile_id INTEGER,
        FOREIGN KEY (pic_id) REFERENCES termproject_pics(pic_id),
        FOREIGN KEY (profile_id) REFERENCES termproject_profiles(profile_id)
    )";

    $stmt = $conn->prepare($sqlTableCreatePicsSaved);
    $stmt->execute();
?>