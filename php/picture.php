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
                class="img-fluid rounded-circle"
            />
        </div>  
    </div>
</div>
<?php
    include SITE_ROOT."/includes/footer.php";
?>