<?php
include '../uc/pacientAccountCreation/pacientAccountCreationController.php';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Creare cont pacient</h5>
    <div class="row mt-2">
        <div class="col-12">
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <form action="/pages/pacientAccountCreationPage.php" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <label for="email" class="form-label">Adresa de email</label>
                <input type="email" class="form-control" id="email" autocomplete="false" name="email"
                       value="<?php echo $pacient->getEmail() ?>">
                <?php if ($errEmailMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errEmailMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="lastName" class="form-label">Nume</label>
                <input type="text" class="form-control" id="lastName" autocomplete="false" name="lastName"
                       value="<?php echo $pacient->getLastName() ?>">
                <?php if ($errLastNameMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errLastNameMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="firstName" class="form-label">Prenume</label>
                <input type="text" class="form-control" id="firstName" autocomplete="false" name="firstName"
                       value="<?php echo $pacient->getFirstName() ?>">
                <?php if ($errFirstNameMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errFirstNameMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="cnp" class="form-label">CNP</label>
                <input type="text" class="form-control" id="cnp" autocomplete="false" name="cnp"
                       value="<?php echo $pacient->getCnp() ?>">
                <?php if ($errCnpMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errCnpMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="password" class="form-label">Parola</label>
                <input type="password" class="form-control" id="password" autocomplete="false" name="password"
                       value="<?php echo $pacient->getPassword() ?>">
                <?php if ($errPasswordMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errPasswordMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="passwordConfirmation" class="form-label">Confirmare parola</label>
                <input type="password" class="form-control" id="passwordConfirmation" autocomplete="false"
                       name="passwordConfirmation" value="<?php echo $pacient->getPasswordConfirmation() ?>">
                <?php if ($errPasswordConfirmationMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errPasswordConfirmationMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <p>Pe emailul introdus veti primi un cod de verificare pe care trebuie sa-l introduceti in pagina de
                    confirmare cont </p>
            </div>
        </div>
        <div class="g-recaptcha" data-sitekey="6LcnIs0jAAAAAGkLBjtjjt6l1iKKCQ_49zbctjFo"></div>
        <div class="row mt-2 mb-2">
            <div class="col-12">
                <input class="btn btn-primary" type="submit" name="submit" value="Creeaza cont">
            </div>
        </div>
    </form>
</div>
</body>
</html>