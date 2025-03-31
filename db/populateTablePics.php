<?php
    //include dbConnection.php before including this
    $sqlTableInsertPics = "INSERT INTO termproject_pics
    (pic_path) 
    VALUES (?)";

    //check if table has records
    $sqlTableSelectPics = "SELECT * FROM termproject_pics";
    $stmt = $conn->prepare($sqlTableSelectPics);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        //if no records, populate table with all files in /pics
        $dir = new DirectoryIterator(SITE_ROOT."/pics/");
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $stmt = $conn->prepare($sqlTableInsertPics);
                $value = $fileinfo->getFilename();
                $stmt->bind_param("s", $value);
                $stmt->execute();
            }
        }
    }
    
?>