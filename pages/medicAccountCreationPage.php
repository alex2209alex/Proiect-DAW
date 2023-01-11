<?php
include '../uc/medicAccountCreation/medicAccountCreationController.php';
$pageTitle = 'Creare cont medic';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Creare cont medic</h5>
    <div class="row mt-2">
        <div class="col-12">
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <form action="/pages/medicAccountCreationPage.php" method="post" novalidate>
        <input type="hidden" name="csfrToken" value="<?php echo $_SESSION["csfrToken"] ?>">
        <div class="row mt-2">
            <div class="col-12">
                <label for="email" class="form-label">Adresa de email</label>
                <input type="email" class="form-control" id="email" autocomplete="false" name="email"
                       value="<?php echo $medic->getEmail() ?>">
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
                       value="<?php echo $medic->getLastName() ?>">
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
                       value="<?php echo $medic->getFirstName() ?>">
                <?php if ($errFirstNameMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errFirstNameMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="cnp" class="form-label">Specializare</label>
                <input type="text" class="form-control" id="cnp" autocomplete="false" name="specialization"
                       value="<?php echo $medic->getSpecialization() ?>">
                <?php if ($errSpecializationMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errSpecializationMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="password" class="form-label">Parola</label>
                <input type="password" class="form-control" id="password" autocomplete="false" name="password"
                       value="<?php echo $medic->getPassword() ?>">
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
                       name="passwordConfirmation" value="<?php echo $medic->getPasswordConfirmation() ?>">
                <?php if ($errPasswordConfirmationMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errPasswordConfirmationMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Creaza cont</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>