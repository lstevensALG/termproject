<?php
    include "../directory.php";
    $webpageTitle = "Search";
    include SITE_ROOT."/includes/header.php";
?>

<?php
   $searchQuery = '';
   if (isset($_POST['search'])) {
       $searchQuery = $_POST['search'];
   }
?>

<div class="container">
    <div class="row">
        <?php
        $dir = new DirectoryIterator(SITE_ROOT."/pics/");
        foreach ($dir as $fileinfo) {
        if(str_contains(strtolower($fileinfo->getFilename()),  strtolower($searchQuery))) {
            if (!$fileinfo->isDot()) {
            $value = $fileinfo->getFilename();
            echo <<<END
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="/php/picture.php?pic_path=$value">
                            <img
                                src="/pics/$value"
                                alt=""
                                class="img-fluid rounded-circle picture-size"
                            />
                        </a>
                    </div>
                </div>
            </div>
            END;
            }
        }
    }
        ?>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>