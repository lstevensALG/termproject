<?php
    include "../directory.php";
    $webpageTitle = "Sign Up";
    include SITE_ROOT."/includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-6">
        <form class="row g-3" action="signupReceive.php" method="POST">
            <div class="col-12">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputUsername" name="username">
            </div>
            <div class="col-6">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
            <div class="col-6">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="passwordConfirm">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
    </div>
</div>

<?php
    include SITE_ROOT."/includes/footer.php";
?>