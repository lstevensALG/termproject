<?php
    include "../directory.php";
    $webpageTitle = "Home";
    include SITE_ROOT."/includes/header.php";
?>

<?php
if(isset($_POST['save'])){

}
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
            echo var_dump($_POST);
        }
        ?>
        </div>
        <div class="col-md-3 mt-5">

        </div>
        <div class="col-md-3 mt-5">

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