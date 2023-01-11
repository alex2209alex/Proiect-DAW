<?php
include '../uc/logout/logoutController.php';
$pageTitle = 'Logout';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Deconectare din aplicatie</h5>
    <form action="/pages/logoutPage.php" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Deconectare</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>