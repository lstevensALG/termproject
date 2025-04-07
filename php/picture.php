<?php
    include "../directory.php";
    $webpageTitle = "Home";
    include SITE_ROOT."/includes/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img
                src="/pics/<?php echo $_GET['pic_path'];?>"
                alt=""
                class="img-fluid"
            />
        </div>
        <div class="col-md-3 mt-5">
        <?php
        if(isset($_SESSION['profile_id'])){
            echo <<<END
            <form method="POST" action="">
                <div class="search-container d-flex flex-row">
                    <button name="save" type="submit" class="btn btn-primary">Save Image</button>
                </div>
            </form>
            END;
        }
        ?>
        </div>

        <div class="col-md-6 mt-5 text-center">
            <?php
                //Code to save picture to profile
                $success = FALSE;
                if(isset($_POST['save'])) {
                    include SITE_ROOT."/db/dbConnection.php";
                    //get the picture id of current picture
                    $sqlTableSelect = "SELECT pic_id
                    FROM termproject_pics
                    WHERE pic_path = ?";
                    $stmt = $conn->prepare($sqlTableSelect);
                    $stmt->bind_param("s", $_GET['pic_path']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    //if found picture in table
                    if ($result->num_rows > 0) {
                        $success = TRUE;
                        $record = $result->fetch_assoc();
                        $pic_id = $record['pic_id'];
                    }
                    else {
                        echo "<p>Error: Picture not found.</p>";
                    }
                }
                //if found picture in table, check if it's already saved
                if ($success) {
                    $sqlTableSelect = "SELECT *
                    FROM termproject_pics_saved
                    WHERE pic_id = ? AND profile_id = ?";
                    $stmt = $conn->prepare($sqlTableSelect);
                    $stmt->bind_param("ii", $pic_id, $_SESSION['profile_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows != 0) {
                        $success = FALSE;
                        echo "<p>Error: picture already saved.</p>";
                    }
                }
                //if found picture AND not already saved
                if ($success) {
                    $sqlTableInsert = "INSERT INTO termproject_pics_saved (pic_id, profile_id)
                    VALUES (?, ?)";
                    $stmt = $conn->prepare($sqlTableInsert);
                    $stmt->bind_param("ii", $pic_id, $_SESSION['profile_id']);
                    $stmt->execute();
                    echo "<p>Picture successfully saved.</p>";
                }
            ?>
        </div>

        <div class="col-md-3 mt-5 d-flex justify-content-end">
        <?php
        if(isset($_SESSION['profile_id'])){
            echo <<<END
            <form method="POST" action="">
                <div class="search-container d-flex flex-row">
                
                    <button type="submit" class="btn btn-primary">Placeholder</button>
                    
                </div>
                        
            </form>
            END;
        }
        ?>
        </div>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>