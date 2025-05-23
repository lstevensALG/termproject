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
                        <div class="card mb-3 border border-2">
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="/php/picture.php?pic_path=$value">
                                    <img
                                        src="/pics/$value"
                                        alt=""
                                        class="img-fluid rounded-circle picture-size border border-3"
                                    />
                                </a>
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