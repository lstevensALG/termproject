<?php
    include "../directory.php";
    $webpageTitle = "Home";
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
        echo var_dump($_POST);
        ?>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>