<?php
include '../uc/accountConfirmation/accountConfirmationController.php';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Confirmare cont</h5>
    <div class="row mt-2">
        <div class="col-12">
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <form action="/pages/accountConfirmationPage.php" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <label for="email" class="form-label">Adresa de email</label>
                <input type="email" class="form-control" id="email" autocomplete="false" name="email"
                       value="<?php echo $email ?>">
                <?php if ($errEmailMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errEmailMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <label for="activationCode" class="form-label">Cod activare</label>
                <input type="text" class="form-control" id="activationCode" autocomplete="false" name="activationCode"
                       value="<?php echo $activationCode ?>">
                <?php if ($errActivationCodeMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errActivationCodeMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Confirmare</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
