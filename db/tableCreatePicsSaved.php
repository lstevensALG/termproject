<?php
    $sqlTableCreatePicsSaved = "CREATE TABLE IF NOT EXISTS termproject_pics_saved
        (save_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        profile_id FOREIGN KEY REFERENCES termproject_profiles(profile_id),
        pic_id FOREIGN KEY REFERENCES termproject_pics(pic_id)
    )";
?>