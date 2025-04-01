<?php
    include "./directory.php";
    $webpageTitle = "Home";
    include SITE_ROOT."/includes/header.php";
?>

<div class="container">
    <div class="row">
            <?php
                $dir = new DirectoryIterator(SITE_ROOT."/pics/");
                foreach ($dir as $fileinfo) {
                    if (!$fileinfo->isDot()) {
                    $value = $fileinfo->getFilename();
                    echo <<<END
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="d-flex gap-3">
                                <img
                                    src="/pics/$value"
                                    alt=""
                                    class="img-fluid rectangle picture-size"
                                />
                            </div>
                        </div>
                    </div>
                    END;
                    }
                }
            ?>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>