<?php
    //NOTE this will only populate the table if there are no records in the table
    //delete the termproject_pics table,
    //include the tableCreatePics.php,
    //finally,
    //include this file

    //include dbConnection.php before including this

    $sqlTableInsertPics = "INSERT INTO termproject_pics
    (pic_path, pic_name) 
    VALUES (?, '')";

    //check if table has records
    $sqlTableSelectPics = "SELECT pic_path FROM termproject_pics";
    $stmt = $conn->prepare($sqlTableSelectPics);
    $stmt->execute();
    $result = $stmt->get_result();

    $pic_array = [];
    while ($record = $result->fetch_assoc()) {
        $pic_array[] = $record['pic_path'];
    }


    $dir = new DirectoryIterator(SITE_ROOT."/pics/");
    foreach ($dir as $fileinfo) {
        $value = $fileinfo->getFilename();
        if (!$fileinfo->isDot() && !in_array($value, $pic_array) ) {
            $stmt = $conn->prepare($sqlTableInsertPics);
            $stmt->bind_param("s", $value);
            $stmt->execute();
        }
    }
    
?>