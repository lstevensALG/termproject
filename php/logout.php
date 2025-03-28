<?php
    include "../directory.php";
    include SITE_ROOT."/php/redirectHome.php";
    $webpageTitle = "Log Out";
    include SITE_ROOT."/includes/header.php";
?>

<?php
    session_destroy();
    setcookie (session_name(), "", time() - 2000);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="text-center">Logging out.</p>
        </div>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>