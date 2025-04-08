<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $webpageTitle; ?></title>
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/darkmodetoggle.js"></script>
    </head>
    <style>
.container {
    
    padding: 20px; /* Adds spacing inside the container */
    border-radius: 10px; /* Optional: Rounds the corners */
    width:2500px ;


}
.Space{
    align-items: center;
}
</style>
    <body>
        <header class="mb-5">
            <div class="container mt-8">
               <div class="row">
                    <div class="col-md-8 discussion-menu d-flex">

                        <ul class="nav">
                            <li class="nav-itm">
                                <a href="/index.php" class="nav-link text-bg-primary rounded-3">Home</a>
                            </li>
                            <?php
                                if (!isset($_SESSION['profile_id'])) {
                                    echo <<<END
                                    <li class="nav-itm">
                                        <a href="/php/signup.php" class="nav-link">Sign Up</a>
                                    </li>
                                    <li class="nav-itm">
                                        <a href="/php/login.php" class="nav-link text-bg-primary rounded-3">Log In</a>
                                    </li>
                                    END;
                                }
                                else {
                                    echo <<<END
                                    <li class="nav-itm">
                                        <a href="/php/profile.php" class="nav-link">Profile</a>
                                    </li>
                                    <li class="nav-itm">
                                        <a href="/php/logout.php" class="nav-link ">Log Out</a>
                                    </li>
                                    END;
                                }
                            ?>
                            
                            
                        </ul>
                        <div class="d-flex justify-content-end space" >
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm" data-bs-theme-value="dark">Dark</button>
                                <button class="btn btn-light btn-sm" data-bs-theme-value="light">Light</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </header>

