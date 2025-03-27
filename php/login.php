<?php
    include "../directory.php";
    $webpageTitle = "Log In";
    include SITE_ROOT."/includes/header.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form class="row g-3" action="loginReceive.php" method="POST">
                <div class="col-12">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="inputUsername" name="username">
                </div>
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>