<?php
    $sqlTableCreatePics = "CREATE TABLE IF NOT EXISTS termproject_pics
        (pic_id INTEGER PRIMARY KEY AUTO_INCREMENT,
        pic_path VARCHAR(50) NOT NULL,
        pic_name VARCHAR(50) NOT NULL
    )";
?>