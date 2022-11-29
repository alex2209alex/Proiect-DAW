<?php
include '../uc/accountCreation/accountCreationController.php';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
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
    <form action="/pages/accountCreationPage.php" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <label for="email" class="form-label">Adresa de email</label>
                <input type="email" class="form-control" id="email" autocomplete="false" name="email"
                       value="<?php echo $user->getEmail() ?>">
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
                       value="<?php echo $user->getLastName() ?>">
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
                       value="<?php echo $user->getFirstName() ?>">
                <?php if ($errFirstNameMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errFirstNameMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="password" class="form-label">Parola</label>
                <input type="password" class="form-control" id="password" autocomplete="false" name="password"
                       value="<?php echo $user->getPassword() ?>">
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
                       name="passwordConfirmation" value="<?php echo $user->getPasswordConfirmation() ?>">
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
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Creaza cont</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>