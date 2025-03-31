<?php
    include "./directory.php";
    $webpageTitle = "Home";
    include SITE_ROOT."/includes/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                include SITE_ROOT."/db/dbConnection.php";
                include SITE_ROOT."/db/tableCreatePics.php";
                include SITE_ROOT."/db/populateTablePics.php";
            ?>
        </div>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>